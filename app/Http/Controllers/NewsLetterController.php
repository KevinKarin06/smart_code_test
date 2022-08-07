<?php

namespace App\Http\Controllers;

use App\Mail\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Mail::to($request->mail)->send(new NewsLetter());
        return back()->with('status', 'Subscribed!');
    }
}
