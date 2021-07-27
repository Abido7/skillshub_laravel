<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function students()
    {
        $studentRole = Role::where('name', 'student')->first();
        $data['students'] = User::where("role_id", "$studentRole->id")->orderBy('id', 'DESC')->paginate(10);
        // dd($studentRole);
        return view('admin.students.students')->with($data);
    }

    public function showScores(User $user)
    {
        // dd($user->role);
        if ($user->role->name !== 'student') {
            return back();
        }

        $data['student'] = $user;
        $data['exams'] = $user->exams;
        return view('admin.students.show-scores')->with($data);
    }

    public function toggleStatus(User $student, Exam $exam)
    {
        if ($student->role->name !== 'student') {
            return back();
        }

        foreach ($student->exams as $loopedExam) {
            if ($loopedExam->id == $exam->id) {
                $currentExam = $loopedExam;
            }
        }

        $student->exams()->updateExistingPivot($exam->id, [
            'status' => $currentExam->pivot->status == 'open' ? 'closed' : 'open',
        ]);
        return back();
    }
}