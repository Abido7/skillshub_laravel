<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function exams()
    {
        $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'questions_no', 'active')->orderBy("id", "DESC")->paginate(10);
        return view('admin.exams.exams')->with($data);
    }

    public function show(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show')->with($data);
    }

    public function create()
    {
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create-exam')->with($data);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'img' => 'required|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'questions_no' => 'required|integer|min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);

        $imgPath = Storage::disk('uploads')->put('exams', $request->img);


        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img' => $imgPath,
            'skill_id' => $request->skill_id,
            'questions_no' => $request->questions_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'active' => 0,
        ]);


        $request->session()->flash('prev', "$exam->id");
        return redirect(url("/dashboard/exams/create-questions/$exam->id"));
    }


    public function createQuestions(Exam $exam)
    {
        if (session('prev') !== "$exam->id" and session('current') !== "$exam->id") {
            return redirect(url('dashboard/exams'));
        }
        $data['exam_id'] = $exam->id;
        $data['questions_no'] = $exam->questions_no;
        return view('admin.exams.create-questions')->with($data);
    }


    public function storeQuestions(Exam $exam, Request $request)
    {
        $request->session()->flash('current', "$exam->id");

        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',

            'right_answers' => 'required|array',
            'right_answers.*' => 'required|in:1,2,3,4',

            'option_1s' => 'required|array',
            'option_1s.*' => 'required|string|max:255',

            'option_2s' => 'required|array',
            'option_2s.*' => 'required|string|max:255',

            'option_3s' => 'required|array',
            'option_3s.*' => 'required|string|max:255',

            'option_4s' => 'required|array',
            'option_4s.*' => 'required|string|max:255',
        ]);

        for ($i = 0; $i < $exam->questions_no; $i++) {

            Question::create([
                "exam_id" => $exam->id,
                "title" => $request->titles[$i],
                "option_1" => $request->option_1s[$i],
                "option_2" => $request->option_2s[$i],
                "option_3" => $request->option_3s[$i],
                "option_4" => $request->option_4s[$i],
                "right_answer" => $request->right_answers[$i]
            ]);
        }

        $exam->update([
            'active' => 1
        ]);

        // trigger an event for pusher
        event(new ExamAddedEvent);

        return redirect(url("dashboard/exams/show/$exam->id"));
    }


    public function edit(Exam $exam)
    {
        $data['exam'] = $exam;
        $data['skills'] = Skill::select("id", "name")->get();
        return view('admin.exams.edit-exam')->with($data);
    }

    public function update(Request $request, Exam $exam)
    {
        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);

        $imgPath = $exam->img;

        if ($request->hasFile('img')) {
            // unlink(public_path("uploads/ $imgPath"));
            Storage::disk('uploads')->delete($imgPath);
            $imgPath = Storage::disk('uploads')->put('exams', $request->img);
        }



        $exam->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img' => $imgPath,
            'skill_id' => $request->skill_id,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
        ]);


        $request->session()->flash('msg', "Exam Updated successfully");
        return redirect(url("dashboard/exams/show/$exam->id"));
    }


    public function delete(Exam $exam)
    {
        try {
            $imgPath = $exam->img;
            $exam->questions()->delete();
            $exam->delete();
            Storage::disk('uploads')->delete($imgPath);
            $msg = "row deleted successfully";
        } catch (\Throwable $th) {
            $msg = "can't delete this row";
        }
        session()->flash('msg', $msg);
        return back();
    }


    public function showQuestions(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show-questions')->with($data);
    }


    public function editQuestion(Exam $exam, Question $question)
    {
        $data['exam'] = $exam;
        $data['ques'] = $question;
        return view('admin.exams.edit-question')->with($data);
    }

    public function updateQuestion(Request $request, Exam $exam, Question $question)
    {
        $formData = $request->validate([
            'title' => 'required|string|max:500',
            'right_answer' => 'required|in:1,2,3,4',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',
        ]);
        $question->update($formData);
        $request->session()->flash('msg', "Question Updated successfully");

        return redirect(url("dashboard/exams/show/$exam->id/questions"));
    }


    public function toggle(exam $exam)
    {
        // check if user add all question when create question because if not active still 0
        if ($exam->questions()->count() == $exam->questions_no) {
            $exam->update([
                'active' => !$exam->active
            ]);
        }

        return back();
    }
}