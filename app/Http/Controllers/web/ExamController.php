<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        $user = Auth::user();
        $data['canEnterExam'] = true;

        if ($user !== null) {
            // go to pivot table (exam-user) and find user row that have auth user_id and current exam_id
            // if a row founded return true else return null 
            $pivotRow = $user->exams()->where('exam_id', $id)->active()->first();
            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canEnterExam'] = false;
            }
        }
        return view('web.exams.exam')->with($data);
    }

    public function start($examId, Request $request)
    {
        $user = Auth::user();
        // this line create new row in db in pivot table and add(userId, examId) 
        // attach method use with pivot and need one param and second param it will take it from chainning (uesr->exams)
        // check if user enter at first time enter the exam and or the admin opend the exam before for user back it closed after he enter again
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }
        $request->session()->flash('prev', "start/$examId");
        return redirect(url("exams/questions/$examId"));
    }


    public function questions($examId, Request $request)
    {
        if (session('prev') !== "start/$examId") {

            return redirect(url("exams/show/$examId"));
        }

        $data['exam'] = Exam::findOrFail($examId);
        $request->session()->flash('prev', "questions/$examId");

        return view('web.exams.exam-questions')->with($data);
    }
    public function submit($examId, Request $request)
    {
        if (session('prev') !== "questions/$examId") {

            return redirect(url("exams/show/$examId"));
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4'
        ]);

        // calc score 
        $exam = Exam::findorFail($examId);
        $quesNums = $exam->questions->count();
        $points = 0;
        foreach ($exam->questions as  $question) {
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
        $user = Auth::user();
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
        $request->session()->flash('msg', "you finished exam successfully with score $score%");
        return redirect(url("exams/show/$examId"));
    }
}