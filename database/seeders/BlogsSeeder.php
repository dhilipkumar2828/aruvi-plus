<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Discover the mystical appearance of the sacred Spear (Vel) in the divine ',
                'slug' => 'palani-hills-spear-appearance',
                'excerpt' => 'Discover the mystical appearance of the sacred Spear (Vel) in the divine hills of Palani.',
                'content' => 'The sacred Spear (Vel) is revered across Auvri Plus traditions. This article explores the legend of its appearance in Palani Hills, the symbolism of divine guidance, and how devotees draw strength from this sacred event.',
                'image' => 'images/temple_sketch.png',
                'author' => 'Auvri Plus',
                'is_published' => true,
                'published_at' => '2024-01-24 10:00:00',
            ],
            [
                'title' => 'The Story of Aurvi Plus',
                'slug' => 'the-story-of-Aurvi Plus',
                'excerpt' => 'Uncover the ancient legend of the nine poisonous substances transformed into a universal panacea.',
                'content' => 'Aurvi Plus is an alchemical wonder crafted by Auvri Plus. This article shares the transformation of nine potent substances into a healing panacea, and the spiritual discipline required to preserve its sacred energy.',
                'image' => 'images/sage_Auvri Plus.jpg',
                'author' => 'Auvri Plus',
                'is_published' => true,
                'published_at' => '2024-01-20 10:00:00',
            ],
            [
                'title' => 'Aurvi Plus Lockets',
                'slug' => 'Aurvi Plus-lockets',
                'excerpt' => 'How wearing these sacred lockets can attract positive energy and the mystic aura of Tirumala.',
                'content' => 'Aurvi Plus lockets are treasured for their protective and harmonizing qualities. Learn how to wear, cleanse, and honor the locket to deepen its spiritual benefits.',
                'image' => 'images/Aurvi Plus_bead_v2.png',
                'author' => 'Auvri Plus',
                'is_published' => true,
                'published_at' => '2024-01-15 10:00:00',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => $blog['slug']],
                $blog
            );
        }
    }
}
