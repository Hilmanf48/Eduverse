<?php

namespace App\Http\Controllers;

;
use App\Models\Course;
use App\Models\Testimonial;
use App\Models\Category;
use Illuminate\Http\Request;


class LandingPageController extends Controller
{
    public function index()
{
    $featuredCourses = \App\Models\Course::with('category')->latest()->take(4)->get()->map(function ($course) {
        $course->image = $course->image_path 
            ? asset('storage/' . $course->image_path) 
            : asset('images/placeholder.jpg');
        
        // Buat properti baru 'category_name' dari relasi
        $course->category_name = $course->category->name ?? 'Uncategorized';
        return $course;
    });

    // Ambil semua data testimoni dari database YANG SUDAH DISETUJUI
    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->get()->map(function ($testimonial) {
        // Membuat URL gambar yang benar
        $testimonial->image = $testimonial->image_path
            ? asset('storage/' . $testimonial->image_path)
            : 'https://i.pravatar.cc/150?u=' . $testimonial->id; // Avatar placeholder
        
        // Mengubah nama kolom agar sesuai dengan JS di frontend
        $testimonial->memberOf = $testimonial->member_of; 
        return $testimonial;
    });

    // Ambil semua kategori untuk filter di halaman depan
    $categories = \App\Models\Category::all();

    // Kirim semua data yang dibutuhkan ke view
    return view('client.landing', compact('featuredCourses', 'testimonials', 'categories'));
    }
}