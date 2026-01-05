<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submitPublic(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::to('admin@example.com')->send(new ContactNotification($contact));

        return back()->with('success', 'Thanks for reaching out! We’ll get back to you soon.');
    }

    public function submitAuth(Request $request) {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', 'Message sent successfully.');
    }


   
}
