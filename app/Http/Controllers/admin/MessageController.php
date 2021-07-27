<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactResponseMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function messages()
    {
        $data['messages'] = Message::orderBy('id', 'DESC')->paginate(10);
        return view('admin.messages.messages')->with($data);
    }

    public function show(Message $message)
    {
        $data['message'] = $message;
        return view('admin.messages.show')->with($data);
    }
    public function response(Request $request, Message $message)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $receiver = $message->email;
        Mail::to($receiver)->send(new ContactResponseMail($message->name, $request->title, $request->body));
        $request->session()->flash('msg', 'respons sent successfully');
        return back();
    }
}