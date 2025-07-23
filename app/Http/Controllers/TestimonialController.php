<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
       $validated = $request->validate([
        'role' => 'required|string|max:255',
        'member_of' => 'required|string|max:255',
        'quote' => 'required|string|min:20',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
    ]);

    $user = Auth::user();
    $imagePath = null;

    
    if ($request->hasFile('image')) {
        // Simpan gambar ke storage/app/public/testimonials
        $imagePath = $request->file('image')->store('testimonials', 'public');
    }

    Testimonial::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'role' => $validated['role'],
        'member_of' => $validated['member_of'],
        'quote' => $validated['quote'],
        'image_path' => $imagePath,
        'is_approved' => false, 
    ]);

    return back()->with('success', 'Terima kasih! Testimonimu akan kami review.');
    }
}
