<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function set($lang, Request $request)
    {
        $sitelangs = ['ar', 'en'];
        if (!in_array($lang, $sitelangs)) {
            $lang = 'en';
        }
        $request->session()->put('lang', $lang);
        return back();
    }
}