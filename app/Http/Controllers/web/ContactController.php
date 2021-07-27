<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $data['sett'] = Setting::select('email', 'phone')->first();
        return view('web.home.contact')->with($data);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sub' => 'nullable|string|max:255',
            'msg' => 'required|string',
        ]);
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->sub,
            'body' => $request->msg,
        ]);

        $request->session()->flash('msg', 'message sent successfully');
        return back();
    }
}