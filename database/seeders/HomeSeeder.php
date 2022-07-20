<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::insert([
            ['banner_mini_words_title' => '["Come","for","learn"]', 'banner_first_line_title' => 'A Better', 'banner_second_line_title' => 'Learning',
                'banner_second_line_changeable_words' => '["Future","Platform","Era","Point","Area"]', 'banner_third_line_title' => 'Starts Here.',
                'banner_subtitle' => 'While the lovely valley teems with vapour around me, and the meridian sun strikes the upper', 'banner_first_button_name' => 'Take A Tour', 'banner_first_button_link' => '#',
                'banner_second_button_name' => 'Popular Courses', 'banner_second_button_link' => '#', 'banner_image' => 'uploads_demo/home/hero-img.png', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
