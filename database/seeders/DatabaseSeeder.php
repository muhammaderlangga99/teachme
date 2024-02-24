<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Post::factory(100)->create();

        // group of seeders
        Group::create([
            'name' => 'SD',
            'slug' => 'sd',
            'user_id' => User::factory()->create()->id,
            'auto_approval' => 1,
            'about' => 'This is a test group',
            'cover_path' => 'cover_path',
            'thumbnail_path' => asset('img/sd.png'),
            'pinned_post_id' => 1,
        ]);
    }
}
