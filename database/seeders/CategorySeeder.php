<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Nutrition',
                'slug' => 'nutrition',
                'icon' => 'bi-apple',
                'color_class' => 'cat-nutrition',
                'description' => 'Evidence-based nutrition science, anti-inflammatory eating, and dietary plans reviewed by registered dietitians.',
            ],
            [
                'name' => 'Home Remedies',
                'slug' => 'home-remedies',
                'icon' => 'bi-flower2',
                'color_class' => 'cat-remedies',
                'description' => 'Traditional and herbal remedies evaluated against clinical evidence — honest about what works and what doesn\'t.',
            ],
            [
                'name' => 'Mental Health',
                'slug' => 'mental-health',
                'icon' => 'bi-cloud-fill',
                'color_class' => 'cat-mental',
                'description' => 'Stress, anxiety, sleep disorders, and cognitive health — practical guidance backed by psychology research.',
            ],
            [
                'name' => 'Fitness',
                'slug' => 'fitness',
                'icon' => 'bi-lightning-charge-fill',
                'color_class' => 'cat-fitness',
                'description' => 'Exercise science, training protocols, and movement habits that compound over time for lasting health gains.',
            ],
            [
                'name' => 'Sleep',
                'slug' => 'sleep',
                'icon' => 'bi-moon-stars-fill',
                'color_class' => 'cat-sleep',
                'description' => 'Sleep architecture, circadian biology, and evidence-based hygiene practices for restorative rest at every age.',
            ],
            [
                'name' => 'Heart Health',
                'slug' => 'heart-health',
                'icon' => 'bi-heart-fill',
                'color_class' => 'cat-heart',
                'description' => 'Blood pressure, cholesterol, cardiovascular risk — lifestyle and natural approaches reviewed by cardiologists.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
