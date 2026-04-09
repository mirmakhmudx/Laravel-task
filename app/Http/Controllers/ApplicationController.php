<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {

        if($this->chekDate())
        {
            return  redirect()->back()->with('error', 'You can create only 1 application a day ');
        }

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

    private function chekDate()
    {
        if(auth()->user()->applications()->latest()->first() == null){return false;}
        $lastApplication = auth()->user()->applications()->latest()->first();
        $last_app_date = Carbon::parse($lastApplication->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if($last_app_date == $today)
        {
            return true;
        }
    }
}
