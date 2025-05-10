<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display the contact form
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Process the contact form submission
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically send an email
        // For now, we'll just redirect with a success message
        
        /*
        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('info@jobboard.com')->subject($request->subject);
        });
        */

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
