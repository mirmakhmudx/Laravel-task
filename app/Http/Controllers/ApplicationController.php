<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $file?->getClientOriginalName();
        $path = $file?->storeAs('files', $name, 'public');

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf',
        ]);

        $application = Application::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null
        ]);

        return redirect()->back();
    }
}
