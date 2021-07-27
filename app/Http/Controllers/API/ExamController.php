<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = Exam::find($id);
        if ($exam !== null) {
            return new ExamResource($exam);
        } else {
            return response()->json(["msg", "category not found"], 404);
        }
    }

    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->find($id);
        if ($exam !== null) {
            return new ExamResource($exam);
        } else {
            return response()->json(["msg", "category not found"], 404);
        }
    }

    public function start($examId, Request $request)
    {
        $user = $request->user();
        // this line create new row in db in pivot table and add(userId, examId) 
        // attach method use with pivot and need one param and second param it will take it from chainning (uesr->exams)
        // check if user enter at first time enter the exam and or the admin opend the exam before for user back it closed after he enter again
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
            // dd($user->exams);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }
        // dd($user);

        return response()->json(['msg' => 'you started exam']);
    }


    public function submit($examId, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // calc score 
        $exam = Exam::find($examId);
        if ($exam == null) {
            return response()->json(['msg' => 'exam not found'], 400);
        }
        $quesNums = $exam->questions->count();
        $points = 0;
        foreach ($exam->questions as $question) {
            // if there is value in answers array with qustion->id continue
            // another explain 
            // if user enter the ques->id
            if (isset($request->answers[$question->id])) {
                $userAns = $request->answers[$question->id];
                $righAns = $question->right_answer;
                if ($userAns == $righAns) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $quesNums) * 100;

        //calc time mins
        $user = $request->user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->active()->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();
        $timeMins = $submitTime->diffInMinutes($startTime);

        // dd($timeMins);
        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }

        //update pivot row
        $user->exams()->updateExistingpivot($examId, [

            'score' => $score,
            'time_mins' => $timeMins
        ]);
        return response()->json(['msg' => "you submited exam successfully your score is $score"], 201);
    }
}