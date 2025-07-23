<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'quote',
        'member_of',
        'image_path',
        'user_id',
        'is_approved',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
