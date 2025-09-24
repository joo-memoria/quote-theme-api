<?php

namespace Database\Seeders;

use App\Models\ContentAbout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentAbout::create([
            'content' => [
                'hero' => [
                    'title' => 'About GalwayBus Quotes',
                    'subtitle' => 'Your trusted partner for coach and bus hire across Ireland'
                ],
                'mission' => [
                    'title' => 'Our Mission',
                    'description' => 'To connect you with Ireland\'s best bus and coach operators, ensuring you get the perfect transport solution at the best price.',
                    'stats' => [
                        ['number' => '500+', 'label' => 'Trusted Operators'],
                        ['number' => '10,000+', 'label' => 'Happy Customers'],
                        ['number' => '15+', 'label' => 'Years Experience'],
                        ['number' => '32', 'label' => 'Counties Covered']
                    ]
                ],
                'values' => [
                    'title' => 'Our Values',
                    'items' => [
                        [
                            'icon' => 'Shield',
                            'title' => 'Trust & Safety',
                            'description' => 'All our operators are fully licensed and insured, ensuring your peace of mind on every journey.'
                        ],
                        [
                            'icon' => 'Heart',
                            'title' => 'Customer First',
                            'description' => 'Your satisfaction is our priority. We go above and beyond to exceed your expectations.'
                        ],
                        [
                            'icon' => 'Clock',
                            'title' => 'Reliability',
                            'description' => 'Punctual, dependable service you can count on for all your transport needs.'
                        ],
                        [
                            'icon' => 'Star',
                            'title' => 'Excellence',
                            'description' => 'We maintain the highest standards in service quality and vehicle maintenance.'
                        ]
                    ]
                ],
                'story' => [
                    'title' => 'Our Story',
                    'paragraphs' => [
                        'Founded in 2008, GalwayBus Quotes began as a small family business with a simple mission: to make quality bus and coach hire accessible and affordable for everyone in Ireland.',
                        'Over the years, we\'ve built strong relationships with transport operators across all 32 counties, creating Ireland\'s most comprehensive network of trusted bus and coach providers.',
                        'Today, we\'re proud to have facilitated thousands of successful journeys, from intimate family gatherings to large corporate events, always with the same commitment to excellence that started our journey.'
                    ]
                ],
                'commitment' => [
                    'title' => 'Our Commitment to You',
                    'items' => [
                        [
                            'title' => 'Transparent Pricing',
                            'description' => 'No hidden fees - what you see is what you pay'
                        ],
                        [
                            'title' => '24/7 Support',
                            'description' => 'Customer support available when you need it most'
                        ],
                        [
                            'title' => 'Quality Assurance',
                            'description' => 'Carefully vetted operators for your peace of mind'
                        ],
                        [
                            'title' => 'Best Rates',
                            'description' => 'Competitive pricing through our network partnerships'
                        ],
                        [
                            'title' => 'Personal Service',
                            'description' => 'Tailored solutions for your specific needs'
                        ]
                    ]
                ],
                'cta' => [
                    'title' => 'Ready to Get Started?',
                    'subtitle' => 'Get your free quotes today and discover why thousands trust GalwayBus Quotes',
                    'buttonText' => 'Get Free Quotes'
                ]
            ],
            'version' => 1,
            'is_published' => true,
            'url'=>'/about'
        ]);
    }
}
