<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'UI/UX Design']);
        Category::create(['name' => 'Web Development']);
        Category::create(['name' => 'Freelancer']);
        Category::create(['name' => 'Others']);
        
    }
}
