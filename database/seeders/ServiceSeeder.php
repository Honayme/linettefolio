<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'display_order' => 1,
                'title' => 'Pilotage de Projets',
                'excerpt' => 'Je pilote vos projets de communication de la stratégie à la réalisation pour garantir leur succès et leur cohérence.',
                'image_path' => 'img/news/1.jpg',
                'full_content' => '<p class="mb-[15px]">Je pilote vos projets de communication de la stratégie à la réalisation pour garantir leur succès et leur cohérence.</p>
                        <p class="mb-[15px]">J\'orchestre des campagnes multicanaux (web, print, événementiel) et je coordonne les équipes, y compris dans un contexte multiculturel. Mon rôle est d\'assurer que chaque étape, de la conception à la livraison, soit parfaitement exécutée.</p>
                        <p>Une gestion de projet rigoureuse qui assure le respect des délais, la maîtrise du budget et l\'atteinte de vos objectifs stratégiques.</p>',
            ],
            [
                'display_order' => 2,
                'title' => 'Stratégie Social Media',
                'excerpt' => 'Je transforme vos réseaux sociaux en de puissants leviers de croissance et de notoriété pour votre marque.',
                'image_path' => 'img/news/2.jpg',
                'full_content' => '<p class="mb-[15px]">Je transforme vos réseaux sociaux en de puissants leviers de croissance et de notoriété pour votre marque.</p>
                        <p class="mb-[15px]">Je définis et j\'applique des stratégies de contenu qui engagent la communauté. Chez mes précédents employeurs, j\'ai augmenté le nombre d\'abonnés de plus de 65% et le taux d\'engagement de plus de 60%.</p>
                        <p>Une communauté active et fidèle, une image de marque renforcée et une visibilité accrue auprès de vos cibles.</p>',
            ],
            [
                'display_order' => 3,
                'title' => 'Création de Contenus',
                'excerpt' => 'Je conçois et produis des contenus visuels percutants qui captent l\'attention et incarnent votre identité de marque.',
                'image_path' => 'img/news/3.jpg',
                'full_content' => '<p class="mb-[15px]">Je conçois et produis des contenus visuels percutants qui captent l\'attention et incarnent votre identité de marque.</p>
                        <p class="mb-[15px]">Je maîtrise toute la chaîne de production : design graphique (Illustrator, InDesign), shooting photo (de la prise de vue à la post-production) et montage vidéo (Premiere Pro). Je suis capable de créer aussi bien des catalogues de 400 pages que des visuels pour le web.</p>
                        <p>Une autonomie créative complète et des supports de communication professionnels et cohérents sur tous les canaux.</p>',
            ],
            [
                'display_order' => 4,
                'title' => 'Gestion Digitale',
                'excerpt' => 'J\'optimise votre écosystème digital pour améliorer l\'expérience utilisateur et soutenir vos objectifs marketing.',
                'image_path' => 'img/news/4.jpg',
                'full_content' => '<p class="mb-[15px]">J\'optimise votre écosystème digital pour améliorer l\'expérience utilisateur et soutenir vos objectifs marketing.</p>
                        <p class="mb-[15px]">J\'administre et je mets à jour des sites internet sous WordPress pour garantir leur performance. J\'utilise également des outils CRM comme SalesForce pour affiner la gestion de la relation client et les actions marketing.</p>
                        <p>Des plateformes digitales performantes qui agissent comme de véritables outils au service de votre croissance.</p>',
            ],
            [
                'display_order' => 5,
                'title' => 'Organisation d\'Événements',
                'excerpt' => 'Je crée et j\'organise des événements qui marquent les esprits et renforcent vos relations avec vos clients et partenaires.',
                'image_path' => 'img/news/5.jpg',
                'full_content' => '<p class="mb-[15px]">Je crée et j\'organise des événements qui marquent les esprits et renforcent vos relations avec vos clients et partenaires.</p>
                        <p class="mb-[15px]">Je gère toute la logistique, que ce soit pour des événements internes (journées techniques) ou des salons professionnels d\'envergure internationale comme le K-Show. Je m\'assure que chaque détail contribue à une expérience réussie.</p>
                        <p>Des événements professionnels et mémorables qui valorisent votre image de marque et créent des opportunités commerciales.</p>',
            ],
            [
                'display_order' => 6,
                'title' => 'Design de Supports',
                'excerpt' => 'Je traduis vos messages en supports de communication clairs, esthétiques et efficaces.',
                'image_path' => 'img/news/6.jpg',
                'full_content' => '<p class="mb-[15px]">Je traduis vos messages en supports de communication clairs, esthétiques et efficaces.</p>
                        <p class="mb-[15px]">Grâce à ma maîtrise de la suite Adobe, je conçois une large gamme de supports, allant de la publicité et des catalogues print à l\'ensemble des contenus graphiques nécessaires pour les campagnes digitales.</p>
                        <p>Des outils de communication percutants qui vous permettent de vous démarquer et de convaincre votre audience.</p>',
            ],
        ]);
    }
}
