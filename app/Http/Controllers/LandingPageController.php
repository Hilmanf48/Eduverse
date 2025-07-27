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
        $course->image_url = $course->thumbnail
    ? asset('storage/' . $course->thumbnail)
    : asset('images/placeholder.jpg');
        
        
        $course->category_name = $course->category->name ?? 'Uncategorized';
        return $course;
    });

  
    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->get()->map(function ($testimonial) {
        
        $testimonial->image = $testimonial->image_path
            ? asset('storage/' . $testimonial->image_path)
            : 'https://i.pravatar.cc/150?u=' . $testimonial->id; 
        
       
        $testimonial->memberOf = $testimonial->member_of; 
        return $testimonial;
    });

    
    $categories = \App\Models\Category::all();

   
    return view('client.landing', compact('featuredCourses', 'testimonials', 'categories'));
    }
}