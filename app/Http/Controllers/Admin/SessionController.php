<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningSession;
use Illuminate\Http\Request;   


class SessionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);

        LearningSession::create($validated);

        return back()->with('success', 'Sesi baru berhasil ditambahkan!');
    }

    public function destroy(LearningSession $session)
    {
        $session->delete();
        return back()->with('success', 'Sesi berhasil dihapus!');
    }
}
