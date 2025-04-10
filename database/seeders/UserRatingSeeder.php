<?php

namespace Database\Seeders;

use App\Models\UserRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRating::factory()
            ->count(50)
            ->create();
    }
}
