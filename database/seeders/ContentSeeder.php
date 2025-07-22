<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Artikel Dummy
        DB::table('articles')->insert([
            ['title' => 'Artikel 1', 'content' => 'Konten artikel 1'],
            ['title' => 'Artikel 2', 'content' => 'Konten artikel 2'],
            ['title' => 'Artikel 3', 'content' => 'Konten artikel 3'],
            ['title' => 'Artikel 4', 'content' => 'Konten artikel 4'],
            ['title' => 'Artikel 5', 'content' => 'Konten artikel 5'],
            ['title' => 'Artikel 6', 'content' => 'Konten artikel 6'],
            ['title' => 'Artikel 7', 'content' => 'Konten artikel 7'],
            ['title' => 'Artikel 8', 'content' => 'Konten artikel 8'],
            ['title' => 'Artikel 9', 'content' => 'Konten artikel 9'],
            ['title' => 'Artikel 10', 'content' => 'Konten artikel 10'],
        ]);

        // Video Dummy
        DB::table('videos')->insert([
            ['title' => 'Video 1', 'url' => 'https://www.youtube.com/watch?v=1'],
            ['title' => 'Video 2', 'url' => 'https://www.youtube.com/watch?v=2'],
            ['title' => 'Video 3', 'url' => 'https://www.youtube.com/watch?v=3'],
            ['title' => 'Video 4', 'url' => 'https://www.youtube.com/watch?v=4'],
            ['title' => 'Video 5', 'url' => 'https://www.youtube.com/watch?v=5'],
            ['title' => 'Video 6', 'url' => 'https://www.youtube.com/watch?v=6'],
            ['title' => 'Video 7', 'url' => 'https://www.youtube.com/watch?v=7'],
            ['title' => 'Video 8', 'url' => 'https://www.youtube.com/watch?v=8'],
            ['title' => 'Video 9', 'url' => 'https://www.youtube.com/watch?v=9'],
            ['title' => 'Video 10', 'url' => 'https://www.youtube.com/watch?v=10'],
        ]);
    }
}
