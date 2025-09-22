<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;
use Illuminate\Support\Carbon;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Quote::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'mobile_number' => $faker->phoneNumber,
                'additional_info' => $faker->sentence(8),
                'is_confirmation' => $faker->boolean(50),
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
