<?php

namespace Database\Seeders;

use App\Models\ContentHowItWorks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentHowItWorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentHowItWorks::create([
            'content' => [
                'hero' => [
                    'title' => 'How It Works',
                    'subtitle' => 'Getting your perfect bus or coach hire is simple with our 4-step process'
                ],
                'steps' => [
                    'title' => 'Simple 4-Step Process',
                    'items' => [
                        [
                            'step' => '1',
                            'title' => 'Tell Us Your Needs',
                            'description' => 'Fill out our simple form with your journey details, passenger count, and any special requirements.',
                            'icon' => 'FileText'
                        ],
                        [
                            'step' => '2',
                            'title' => 'We Find the Best Matches',
                            'description' => 'Our system connects you with qualified operators in your area who can meet your specific needs.',
                            'icon' => 'Search'
                        ],
                        [
                            'step' => '3',
                            'title' => 'Compare & Choose',
                            'description' => 'Receive multiple competitive quotes and choose the operator that best fits your budget and requirements.',
                            'icon' => 'List'
                        ],
                        [
                            'step' => '4',
                            'title' => 'Book with Confidence',
                            'description' => 'Confirm your booking directly with your chosen operator and enjoy your journey with peace of mind.',
                            'icon' => 'CheckSquare'
                        ]
                    ]
                ],
                'benefits' => [
                    'title' => 'Why Choose Our Service',
                    'items' => [
                        [
                            'icon' => 'Tag',
                            'title' => 'Save Money',
                            'description' => 'Compare multiple quotes to ensure you get the best value for your money.',
                            'color' => 'green'
                        ],
                        [
                            'icon' => 'Clock',
                            'title' => 'Save Time',
                            'description' => 'One form connects you with multiple operators instead of calling them individually.',
                            'color' => 'blue'
                        ],
                        [
                            'icon' => 'Shield',
                            'title' => 'Peace of Mind',
                            'description' => 'All operators are pre-vetted, licensed, and insured for your safety.',
                            'color' => 'purple'
                        ],
                        [
                            'icon' => 'Users',
                            'title' => 'Expert Support',
                            'description' => 'Our team is here to help throughout your journey, from quote to completion.',
                            'color' => 'orange'
                        ]
                    ]
                ],
                'cta' => [
                    'title' => 'Ready to Get Your Quotes?',
                    'subtitle' => 'Join thousands of satisfied customers who found their perfect transport solution',
                    'buttonText' => 'Start Your Quote Request'
                ]
            ],
            'version' => 1,
            'is_published' => true,
            'url'=>'/how-it-works'
        ]);
    }
}
