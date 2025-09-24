<?php

namespace Database\Seeders;

use App\Models\ContentIndex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentIndex::create([
            'content' => [
                'bannerText' => '🔥 Limited Time: Get quotes from 50+ companies - Completely FREE',
                'hero' => [
                    'badge' => '⚡ Get Quotes in Under 2 Hours',
                    'titleLine1' => 'Save Up to 40% on',
                    'titleEmphasis' => 'Bus Hire Costs',
                    'subtitle' => 'Compare quotes from 50+ verified Irish bus companies nationwide. No hidden fees, no obligation. Completely FREE.',
                    'bullets' => [
                        'Instant Quote Comparison',
                        'Best Price Guarantee',
                        'Fully Insured Partners'
                    ],
                    'statCount' => 2847,
                    'statLabel' => 'Successful bookings this month'
                ],
                'indexIntro' => [
                    'heading' => 'Get Your Bus Quote in Under 2 Minutes',
                    'paragraph' => 'Simply fill in your journey details below and we\'ll connect you with up to 5 verified bus companies competing for your business',
                    'highlights' => [
                        '✅ Completely FREE',
                        '✅ No Hidden Fees',
                        '✅ 2-Hour Response',
                        '✅ Save Up to 40%'
                    ]
                ],
                'features' => [
                    'title' => 'Why 10,000+ Customers Choose Quote Pro',
                    'subtitle' => 'The fastest, easiest way to compare bus quotes and save money on group transportation',
                    'items' => [
                        [
                            'icon' => 'DollarSign',
                            'title' => 'Save Up to 40%',
                            'description' => 'Our competitive bidding process ensures you get the best possible price from top-rated bus companies'
                        ],
                        [
                            'icon' => 'Clock',
                            'title' => '2-Hour Response',
                            'description' => 'Get multiple quotes within 2 hours, not days. Most customers receive 3-5 quotes to choose from'
                        ],
                        [
                            'icon' => 'Shield',
                            'title' => '100% Verified Partners',
                            'description' => 'All Irish bus companies are pre-screened, fully licensed, and carry comprehensive insurance coverage'
                        ],
                        [
                            'icon' => 'Star',
                            'title' => '4.9/5 Customer Rating',
                            'description' => 'Join thousands of satisfied Irish customers who saved money and time using our platform'
                        ],
                        [
                            'icon' => 'Users',
                            'title' => '50+ Bus Companies',
                            'description' => 'Access one of the largest networks of professional bus operators across Ireland'
                        ],
                        [
                            'icon' => 'MapPin',
                            'title' => 'Nationwide Coverage',
                            'description' => 'Whether local or long-distance, we have trusted partners covering every major route'
                        ]
                    ],
                    'testimonials' => [
                        [
                            'name' => 'Sarah M.',
                            'role' => 'Wedding Planner',
                            'quote' => 'We saved over €750 on transport for our wedding guests. Everything was quick, simple, and stress-free. Couldn\'t have asked for an easier process!',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Mike R.',
                            'role' => 'Corporate Events',
                            'quote' => 'We found an excellent coach company for our team retreat. The service was professional, reliable, and the price was fantastic.',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Lisa K.',
                            'role' => 'School Trip Coordinator',
                            'quote' => 'Quote Pro made planning our school trip so much easier. The whole booking process was straightforward, and it took a huge weight off my shoulders. Highly recommend!',
                            'rating' => 5
                        ]
                    ],
                    'trustLogos' => ['Stagit.ie', 'Henit.ie', 'GoIrishTours.com']
                ],
                'cta' => [
                    'title' => 'Ready to Save Money on Your Bus Hire?',
                    'subtitle' => 'Join thousands of smart Irish customers who saved up to 40% by comparing quotes',
                    'buttonText' => 'Get FREE Quotes Now',
                    'disclaimer' => 'Takes less than 2 minutes • No spam • Instant processing'
                ],
                'quoteForm' => [
                    'urgencyBanner' => '🔥 Limited Time: Get quotes from 50+ companies - Completely FREE',
                    'cardTitle' => 'Get Your FREE Bus Quotes',
                    'cardSubtitle' => 'Join 10,000+ satisfied Irish customers • No hidden fees • 2-hour response',
                    'trustIndicators' => ['SSL Secured', 'Instant Processing', '50+ Partners'],
                    'fields' => [
                        [
                            'id' => 'first_name',
                            'name' => 'first_name',
                            'label' => 'First Name *',
                            'placeholder' => 'John',
                            'type' => 'text',
                            'required' => true,
                            'width' => 'half',
                            'icon' => 'User'
                        ],
                        [
                            'id' => 'last_name',
                            'name' => 'last_name',
                            'label' => 'Last Name *',
                            'placeholder' => 'Doe',
                            'type' => 'text',
                            'required' => true,
                            'width' => 'half',
                            'icon' => 'User'
                        ],
                        [
                            'id' => 'email',
                            'name' => 'email',
                            'label' => 'Email Address *',
                            'placeholder' => 'your.email@example.com',
                            'type' => 'email',
                            'required' => true,
                            'width' => 'half',
                            'icon' => 'Mail'
                        ],
                        [
                            'id' => 'mobile',
                            'name' => 'mobile',
                            'label' => 'Mobile Number *',
                            'placeholder' => '+353 85 123 4567',
                            'type' => 'tel',
                            'required' => true,
                            'width' => 'half',
                            'icon' => 'Phone'
                        ],
                        [
                            'id' => 'additionalInfo',
                            'name' => 'additionalInfo',
                            'label' => 'Additional Information *',
                            'placeholder' => 'Special requirements, accessibility needs, timing constraints, etc...',
                            'type' => 'textarea',
                            'required' => true,
                            'width' => 'full',
                            'icon' => 'MessageSquare'
                        ]
                    ],
                    'layout' => [
                        [
                            'id' => 'row_1',
                            'columns' => [
                                [
                                    'id' => 'col_1_1',
                                    'fieldIds' => ['first_name']
                                ],
                                [
                                    'id' => 'col_1_2',
                                    'fieldIds' => ['last_name']
                                ]
                            ]
                        ],
                        [
                            'id' => 'row_2',
                            'columns' => [
                                [
                                    'id' => 'col_2_1',
                                    'fieldIds' => ['email']
                                ],
                                [
                                    'id' => 'col_2_2',
                                    'fieldIds' => ['mobile']
                                ]
                            ]
                        ],
                        [
                            'id' => 'row_3',
                            'columns' => [
                                [
                                    'id' => 'col_3_1',
                                    'fieldIds' => ['additionalInfo']
                                ]
                            ]
                        ]
                    ],
                    'labels' => [
                        'firstName' => 'First Name *',
                        'lastName' => 'Last Name *',
                        'email' => 'Email Address *',
                        'mobile' => 'Mobile Number *',
                        'additionalInfo' => 'Additional Information *',
                        'submitText' => '🚌 Get My FREE Quotes Now - Save Up to 40%',
                        'submittingText' => 'Processing Your Request...'
                    ],
                    'placeholders' => [
                        'firstName' => 'John',
                        'lastName' => 'Doe',
                        'email' => 'your.email@example.com',
                        'mobile' => '+353 85 123 4567',
                        'additionalInfo' => 'Special requirements, accessibility needs, timing constraints, etc...'
                    ]
                ]
            ],
            'version' => 1,
            'is_published' => true,
            'url'=>'/'
        ]);
    }
}
