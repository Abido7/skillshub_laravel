<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::orderBy('id', 'DESC')->paginate(8);
        // dd($data['exams']);
        return view('web.home.index')->with($data);
    }
}