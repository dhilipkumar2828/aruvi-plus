<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Ramesh',
            'designation' => '',
            'content' => 'Navapashanam water brought a remarkable change—more energy, less fatigue, and heightened cheerfulness. Grateful for the divine energy boost!',
            'rating' => 5,
            'image' => 'images/testimonial ramesh.png',
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'Karthik',
            'designation' => '',
            'content' => 'Since acquiring the Navapashanam bead, my life has significantly improved. Wearing it and consuming the water has enhanced my clarity and alertness.',
            'rating' => 5,
            'image' => 'images/karthik.png',
            'is_active' => true,
        ]);
    }
}
