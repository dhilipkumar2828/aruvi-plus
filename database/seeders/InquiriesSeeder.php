<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Lakshmi Raj',
                'email' => 'lakshmi@example.com',
                'phone' => '+91 98765 11001',
                'subject' => 'Shipping timeline',
                'message' => 'How long does shipping take for the Murugan statue to Chennai?',
                'status' => 'new',
            ],
            [
                'name' => 'Vinod S.',
                'email' => 'vinod@example.com',
                'phone' => '+91 98765 11002',
                'subject' => 'Authenticity certificate',
                'message' => 'Do you provide a lab certification with each Aurvi Plus product?',
                'status' => 'replied',
            ],
            [
                'name' => 'Meera Anand',
                'email' => 'meera@example.com',
                'phone' => '+91 98765 11003',
                'subject' => 'Custom engraving',
                'message' => 'Is it possible to engrave a name on the sacred chain?',
                'status' => 'new',
            ],
            [
                'name' => 'Suresh P.',
                'email' => 'suresh@example.com',
                'phone' => '+91 98765 11004',
                'subject' => 'Care instructions',
                'message' => 'Please share the care instructions for the Shivlingam.',
                'status' => 'closed',
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::updateOrCreate(
                ['email' => $inquiry['email'], 'subject' => $inquiry['subject']],
                $inquiry
            );
        }
    }
}
