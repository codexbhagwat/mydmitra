<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UpdateNotification;
use App\Models\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UpdateController extends Controller
{
    public function index()
    {
        $updates = Update::latest()->paginate(10);
        return view('admin.updates.index', compact('updates'));
    }

    public function create()
    {
        return view('admin.updates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $update = Update::create([
            'title'       => $request->title,
            'description' => $request->description,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        // Sabhi users nikalo jinka email hai
        $users = User::whereNotNull('email')
                     ->where('email', '!=', '')
                     ->get(['email', 'first_name']);

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(
                    new UpdateNotification(
                        $update->title,
                        $update->description,
                        $user->first_name ?? 'User'
                    )
                );
            } catch (\Exception $e) {
                \Log::error('Mail failed to: ' . $user->email . ' | ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.updates.index')
                         ->with('success', 'Update published & emails sent to ' . $users->count() . ' users!');
    }

    public function edit(Update $update)
    {
        return view('admin.updates.edit', compact('update'));
    }

    public function update(Request $request, Update $update)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $update->update([
            'title'       => $request->title,
            'description' => $request->description,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.updates.index')
                         ->with('success', 'Update saved successfully!');
    }

    public function destroy(Update $update)
    {
        $update->delete();
        return redirect()->route('admin.updates.index')
                         ->with('success', 'Update deleted.');
    }
}