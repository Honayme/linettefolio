<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vide la table avant de la remplir pour éviter les doublons
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'Réalisation graphiques Web' => [
                'LinkedIn',
                'Instagram',
                'Newsletter',
                'Youtube',
            ],
            'Réalisations graphiques Print' => [
                'Brochures',
                'Evènements',
                'Catalogues',
                'Panneau',
                'Publicité',
            ],
            'Supports internes' => [
                'Cartes de visite',
                'Présentation powerpoint',
            ],
            'Photos & videos' => [
                'Avant / après retouches photos',
                'Vidéos produits',
                'Témoignage / interview',
                'Gestion de la page youtube',
            ],
        ];

        $order = 1;
        foreach ($categories as $parentName => $children) {
            // Crée la catégorie parente avec la colonne d'ordre
            $parent = Category::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'order_column' => $order,
            ]);

            // Crée les catégories enfants et les associe au parent
            // Pas de 'order_column' ici, elles seront null par défaut
            foreach ($children as $childName) {
                Category::create([
                    'parent_id' => $parent->id,
                    'name' => $childName,
                    'slug' => Str::slug(Str::slug($parentName) . '-' . $childName),
                ]);
            }

            $order++; // Incrémente pour la prochaine catégorie parente
        }
    }
}
