<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Dr. Sarah Mitchell',
                'role' => 'Cardiologist & Medical Advisor',
                'initials' => 'SM',
                'avatar_url' => null,
                'bio' => 'Board-certified cardiologist with 15 years of clinical experience. Specializes in preventive cardiology and lifestyle medicine.',
            ],
            [
                'name' => 'Emma Rhodes',
                'role' => 'Registered Dietitian',
                'initials' => 'ER',
                'avatar_url' => null,
                'bio' => 'Registered dietitian and nutrition researcher focused on anti-inflammatory diets and long-term behaviour change.',
            ],
            [
                'name' => 'James Okafor',
                'role' => 'Naturopathic Doctor',
                'initials' => 'JO',
                'avatar_url' => null,
                'bio' => 'Licensed naturopathic doctor with expertise in herbal medicine, adaptogens, and integrative health protocols.',
            ],
            [
                'name' => 'Dr. Priya Nair',
                'role' => 'Sleep Medicine Specialist',
                'initials' => 'PN',
                'avatar_url' => null,
                'bio' => 'Sleep medicine physician and chronobiology researcher. Helps patients understand and improve their circadian rhythms.',
            ],
            [
                'name' => 'Carlos Mendez',
                'role' => 'Certified Strength & Conditioning Specialist',
                'initials' => 'CM',
                'avatar_url' => null,
                'bio' => 'CSCS-certified coach specialising in endurance training, Zone 2 methodology, and longevity-focused fitness.',
            ],
            [
                'name' => 'Dr. Maya Chen',
                'role' => 'Integrative Medicine Physician',
                'initials' => 'MC',
                'avatar_url' => null,
                'bio' => 'Integrative medicine physician combining conventional and evidence-based natural approaches for holistic patient care.',
            ],
        ];

        foreach ($authors as $author) {
            Author::firstOrCreate(
                ['name' => $author['name']],
                $author
            );
        }
    }
}
