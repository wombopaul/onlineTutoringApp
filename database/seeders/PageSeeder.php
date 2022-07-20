<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert([
            ['id' => 1, 'uuid' => Str::uuid()->toString(), 'en_title' => 'Privacy Policy', 'en_description' => 'Privacy Policy', 'slug' => 'privacy-policy', 'meta_description' => 'Privacy Policy', 'meta_keywords' => 'Privacy,Policy', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'uuid' => Str::uuid()->toString(), 'en_title' => 'Cookie Policy', 'en_description' => 'Cookie Policy', 'slug' => 'privacy-policy', 'meta_description' => 'Cookie Policy', 'meta_keywords' => 'Cookie,Policy', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
