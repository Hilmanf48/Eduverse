<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        
        $featuredCourses = Course::latest()->take(4)->get()->map(function ($course) {
            // Membuat URL gambar yang benar
            $course->image = $course->image_path 
                ? asset('storage/' . $course->image_path) 
                : asset('images/placeholder.jpg'); 
            
            // Menggunakan kategori dari database
            $course->category = $course->category ?? 'uncategorized';

            return $course;
        });

        
        $testimonials = [ /* ... data testimoni... */ ];

        // Kirim data ke view
        return view('client.landing', compact('featuredCourses', 'testimonials'));
    }
}