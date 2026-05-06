<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // TODO: swap this for Mail::to() once you set up email
        Log::info('Contact form submission', $request->only('name', 'email', 'subject', 'message'));

        return redirect('/contact')->with('success', true);
    }
}