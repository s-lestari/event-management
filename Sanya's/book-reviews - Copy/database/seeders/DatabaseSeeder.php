<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(count: 8)->create()->each(function ($book) {
            $numReviews = random_int(5, 10);

        Review::factory()->count($numReviews)
                ->good()
                ->for($book)
                ->create();
        });

        Book::factory(7)->create()->each(function ($book) {
            $numReviews = random_int(5, 10);

            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(count: 5)->create()->each(function ($book) {
            $numReviews = random_int(5, 10);

            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
