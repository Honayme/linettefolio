<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeContent::create([
            'greeting_text' => 'Hey! I\'m Michel',
            'main_title' => 'Digital<br class="hidden sm:block"> Designer',
            'description' => 'I specialize in crafting user‑centered digital experiences that blend strategy, storytelling, and clean aesthetics helping businesses stand out.',
            'cta_button_text' => 'Let\'s Contact',
            'cta_button_url' => '/contact',
            'hero_image' => 'img/banner-image.jpg',
            'hero_image_alt' => 'Hero image',
        ]);
    }
}
