<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. On vide les tables pour repartir sur une base propre à chaque seed.
        // On désactive temporairement les contraintes de clés étrangères.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('portfolio_items')->truncate();

        DB::table('category_portfolio_item')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. On récupère les catégories qui nous intéressent pour les associations.
        // C'est plus performant de tout charger une fois.
        $linkedinCategory = Category::where('slug', 'realisation-graphiques-web-linkedin')->first();
        $brochureCategory = Category::where('slug', 'realisations-graphiques-print-brochures')->first();
        $videoCategory = Category::where('slug', 'photos-videos-videos-produits')->first();
        $businessCardCategory = Category::where('slug', 'supports-internes-cartes-de-visite')->first();
        $instagramCategory = Category::where('slug', 'realisation-graphiques-web-instagram')->first();
        $newsletterCategory = Category::where('slug', 'realisation-graphiques-web-newsletter')->first();
        $eventCategory = Category::where('slug', 'realisations-graphiques-print-evenements')->first();
        $catalogCategory = Category::where('slug', 'realisations-graphiques-print-catalogues')->first();
        $adCategory = Category::where('slug', 'realisations-graphiques-print-publicite')->first();
        $powerpointCategory = Category::where('slug', 'supports-internes-presentation-powerpoint')->first();
        $retouchingCategory = Category::where('slug', 'photos-videos-avant-apres-retouches-photos')->first();
        $interviewCategory = Category::where('slug', 'photos-videos-temoignage-interview')->first();
        $youtubeCategory = Category::where('slug', 'photos-videos-gestion-de-la-page-youtube')->first();

        // 3. On crée les éléments du portfolio et on les attache aux catégories.

        // --- EXEMPLE 1: Un projet simple attaché à une seule catégorie ---
        if ($linkedinCategory) {
            $item1 = PortfolioItem::create([
                'title' => 'Campagne de Posts LinkedIn pour Acme Corp',
                'description' => 'Création d\'une série de 10 visuels percutants pour la campagne de recrutement d\'Acme Corp sur LinkedIn, visant à augmenter l\'engagement de 50%.',
                'layout' => 'image',
                'cover_image' => 'portfolio/linkedin-cover.jpg',
                'cover_image_alt' => 'Exemple de post LinkedIn pour Acme Corp',
                'images' => [ // Laravel s'occupe de caster cet array en JSON
                    'portfolio/linkedin-image-1.jpg',
                    'portfolio/linkedin-image-2.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);

            // On attache l'item à la catégorie "LinkedIn"
            $item1->categories()->attach($linkedinCategory->id);
        }

        // --- EXEMPLE 2: Un projet Print ---
        if ($brochureCategory) {
            $item2 = PortfolioItem::create([
                'title' => 'Brochure Commerciale "Prestige"',
                'description' => 'Conception et mise en page d\'une brochure de 16 pages pour le lancement d\'une nouvelle gamme de produits de luxe.',
                'layout' => 'image',
                'cover_image' => 'portfolio/brochure-cover.jpg',
                'cover_image_alt' => 'Couverture de la brochure commerciale Prestige',
                'images' => [
                    'portfolio/brochure-page-1.jpg',
                    'portfolio/brochure-page-2.jpg',
                    'portfolio/brochure-page-3.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item2->categories()->attach($brochureCategory->id);
        }

        // --- EXEMPLE 3: Un projet vidéo attaché à DEUX catégories ---
        if ($videoCategory && $youtubeCategory) {
            $item3 = PortfolioItem::create([
                'title' => 'Vidéo de Présentation Produit "AquaPure"',
                'description' => 'Réalisation d\'une vidéo motion design de 60 secondes pour présenter les fonctionnalités du filtre à eau AquaPure.',
                'layout' => 'video',
                'cover_image' => 'portfolio/video-cover.jpg',
                'cover_image_alt' => 'Miniature de la vidéo produit AquaPure',
                'images' => null,
                'video_url' => 'https://www.youtube.com/watch?v=exemple',
                'is_visible' => true,
            ]);

            // On peut attacher plusieurs catégories en passant un array d'IDs
            $item3->categories()->attach([$videoCategory->id, $youtubeCategory->id]);
        }

        // --- EXEMPLE 4: Un projet non visible ---
        if ($businessCardCategory) {
            $item4 = PortfolioItem::create([
                'title' => 'Design de Cartes de Visite "Innovatech"',
                'description' => 'Création d\'une nouvelle identité pour les cartes de visite de l\'entreprise Innovatech, avec finition vernis sélectif.',
                'layout' => 'image',
                'cover_image' => 'portfolio/cards-cover.jpg',
                'cover_image_alt' => 'Design des cartes de visite Innovatech',
                'images' => ['portfolio/card-mockup-1.jpg'],
                'video_url' => null,
                'is_visible' => false, // Cet item n'apparaîtra pas sur le site public
            ]);
            $item4->categories()->attach($businessCardCategory->id);
        }

        // --- EXEMPLE 5: Projet Instagram ---
        if ($instagramCategory) {
            $item5 = PortfolioItem::create([
                'title' => 'Grille Instagram pour "Urban Coffee"',
                'description' => 'Conception d\'une série de 9 visuels harmonieux pour le lancement du compte Instagram du café "Urban Coffee".',
                'layout' => 'image',
                'cover_image' => 'portfolio/insta-cover.jpg',
                'cover_image_alt' => 'Grille de 9 posts Instagram pour Urban Coffee',
                'images' => [
                    'portfolio/insta-post-1.jpg',
                    'portfolio/insta-post-2.jpg',
                    'portfolio/insta-post-3.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item5->categories()->attach($instagramCategory->id);
        }

        // --- EXEMPLE 6: Projet Newsletter ---
        if ($newsletterCategory) {
            $item6 = PortfolioItem::create([
                'title' => 'Template Newsletter "Tech Weekly"',
                'description' => 'Création d\'un template de newsletter responsive pour la diffusion hebdomadaire des actualités de "Tech Weekly".',
                'layout' => 'image',
                'cover_image' => 'portfolio/newsletter-cover.jpg',
                'cover_image_alt' => 'Aperçu du template de la newsletter Tech Weekly',
                'images' => ['portfolio/newsletter-full.jpg'],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item6->categories()->attach($newsletterCategory->id);
        }

        // --- EXEMPLE 7: Branding d'événement ---
        if ($eventCategory) {
            $item7 = PortfolioItem::create([
                'title' => 'Identité Visuelle pour le "Sommet de l\'Innovation"',
                'description' => 'Déclinaison de l\'identité visuelle sur différents supports (badges, bannières, signalétique) pour un événement professionnel majeur.',
                'layout' => 'slider',
                'cover_image' => 'portfolio/event-cover.jpg',
                'cover_image_alt' => 'Bannière principale du Sommet de l\'Innovation',
                'images' => [
                    'portfolio/event-badge.jpg',
                    'portfolio/event-kakemono.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item7->categories()->attach($eventCategory->id);
        }

        // --- EXEMPLE 8: Catalogue Produit (multi-catégories) ---
        if ($catalogCategory && $adCategory) {
            $item8 = PortfolioItem::create([
                'title' => 'Catalogue Annuel "Mobilier Design"',
                'description' => 'Mise en page du catalogue de 80 pages présentant la nouvelle collection. Le projet incluait aussi la création d\'encarts publicitaires pour la presse spécialisée.',
                'layout' => 'slider',
                'cover_image' => 'portfolio/catalog-cover.jpg',
                'cover_image_alt' => 'Couverture du catalogue Mobilier Design',
                'images' => [
                    'portfolio/catalog-page-1.jpg',
                    'portfolio/catalog-ad-1.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item8->categories()->attach([$catalogCategory->id, $adCategory->id]);
        }

        // --- EXEMPLE 9: Présentation PowerPoint ---
        if ($powerpointCategory) {
            $item9 = PortfolioItem::create([
                'title' => 'Modèle de Présentation d\'Entreprise',
                'description' => 'Création d\'un master template PowerPoint personnalisable pour uniformiser les présentations internes et externes.',
                'layout' => 'presentation',
                'cover_image' => 'portfolio/ppt-cover.jpg',
                'cover_image_alt' => 'Slide de titre du modèle PowerPoint',
                'images' => [
                    'portfolio/ppt-slide-1.jpg',
                    'portfolio/ppt-slide-2.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item9->categories()->attach($powerpointCategory->id);
        }

        // --- EXEMPLE 10: Retouche photo ---
        if ($retouchingCategory) {
            $item10 = PortfolioItem::create([
                'title' => 'Retouche de Portraits Corporatifs',
                'description' => 'Amélioration de la colorimétrie, suppression des imperfections et détourage sur une série de portraits pour le site web de l\'entreprise.',
                'layout' => 'image',
                'cover_image' => 'portfolio/retouch-after.jpg',
                'cover_image_alt' => 'Portrait d\'un dirigeant après retouche',
                'images' => [
                    'portfolio/retouch-before-1.jpg',
                    'portfolio/retouch-after-1.jpg',
                ],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item10->categories()->attach($retouchingCategory->id);
        }

        // --- EXEMPLE 11: Interview vidéo (multi-catégories) ---
        if ($interviewCategory && $youtubeCategory) {
            $item11 = PortfolioItem::create([
                'title' => 'Interview de Client "Success Story"',
                'description' => 'Tournage et montage d\'une interview d\'un client satisfait, destinée à être diffusée sur YouTube et les réseaux sociaux.',
                'layout' => 'video',
                'cover_image' => 'portfolio/interview-cover.jpg',
                'cover_image_alt' => 'Miniature de l\'interview vidéo',
                'images' => null,
                'video_url' => 'https://www.youtube.com/watch?v=exemple-interview',
                'is_visible' => true,
            ]);
            $item11->categories()->attach([$interviewCategory->id, $youtubeCategory->id]);
        }

        // --- EXEMPLE 12: Publicité Presse ---
        if ($adCategory) {
            $item12 = PortfolioItem::create([
                'title' => 'Annonce Presse pour "Montres Hélice"',
                'description' => 'Création d\'une publicité pleine page pour le magazine "Luxe & Tendance" afin de promouvoir un nouveau modèle de montre.',
                'layout' => 'image',
                'cover_image' => 'portfolio/ad-cover.jpg',
                'cover_image_alt' => 'Publicité pour les montres Hélice dans un magazine',
                'images' => ['portfolio/ad-mockup.jpg'],
                'video_url' => null,
                'is_visible' => true,
            ]);
            $item12->categories()->attach($adCategory->id);
        }
    }
}
