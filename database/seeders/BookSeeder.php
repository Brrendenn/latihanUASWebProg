<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i = 0; $i < 10; $i++) {
            Book::create([
                'title' => fake()->sentence(3),
                'price' => fake()->numberBetween(50000, 200000),
                'image_path' => 'placeholder.jpg',
            ]);
        }
    }
}
