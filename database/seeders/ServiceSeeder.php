<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contenu détaillé qui est le même pour tous les services de l'exemple
        $fullContent = '<p class="mb-[15px]">Tokyo is a leading web design agency with an award-winning design team that creates innovative, effective websites that capture your brand, improve your conversion rates, and maximize your revenue to help grow your business and achieve your goals.</p>
                        <p class="mb-[15px]">In today’s digital world, your website is the first interaction consumers have with your business. That\'s why almost 95 percent of a user’s first impression relates to web design. It’s also why web design services can have an immense impact on your company’s bottom line.</p>
                        <p>That’s why more companies are not only reevaluating their website’s design but also partnering with Tokyo, the web design agency that’s driven more than $2.4 billion in revenue for its clients. With over 50 web design awards under our belt, we\'re confident we can design a custom website that drives sales for your unique business.</p>';

        // Tableau contenant tous vos services
        $services = [
            [
                'display_order' => 1,
                'title' => 'Web Design',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/1.jpg',
                'full_content' => $fullContent,
            ],
            [
                'display_order' => 2,
                'title' => 'Content Writing',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/2.jpg',
                'full_content' => $fullContent,
            ],
            [
                'display_order' => 3,
                'title' => 'Brand Identity',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/3.jpg',
                'full_content' => $fullContent,
            ],
            [
                'display_order' => 4,
                'title' => 'Live Chat',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/4.jpg',
                'full_content' => $fullContent,
            ],
            [
                'display_order' => 5,
                'title' => 'After Effects',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/5.jpg',
                'full_content' => $fullContent,
            ],
            [
                'display_order' => 6,
                'title' => 'Mobile App',
                'excerpt' => 'Web development is the most famous job in the world and it is very interesting...',
                'image_path' => 'img/news/2.jpg',
                'full_content' => $fullContent,
            ],
        ];

        // Boucle pour créer chaque service dans la base de données
        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}
