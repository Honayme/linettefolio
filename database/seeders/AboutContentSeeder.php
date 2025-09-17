<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutContent::create([
            // Informations principales
            'page_title' => 'About Me',
            'hero_image' => 'img/slider/1.jpg',
            'hero_image_alt' => 'Description pertinente de l\'image',
            'full_name' => 'Lina-Marie MICHEL',
            'job_title' => 'Marketing & Communication',
            'description' => 'Chargée de communication et marketing digital avec plus de 6 ans d\'expérience. Gestion de projets multicanaux, community management et graphic design (print & web).\n\nActuellement en poste chez Pellenc ST, je suis habituée à travailler en équipe multiculturelle, à piloter des projets et à m\'adapter au besoin.',

            // Informations personnelles
            'address' => '88c rue de bas vernaz, 74240 GAILLARD',
            'email' => 'lina-marie.michel@hotmail.fr',
            'phone' => '+33 6 05 27 66 22',
            'driving_license' => 'Permis B, véhiculée',
            'nationality' => 'Française',
            'education_school' => 'ESUPCOM',
            'education_degree' => 'Master',
            'languages' => 'Français, Anglais (B2), Italien',

            // Skills
            'skills_section1_title' => 'Graphisme & Web',
            'skills_section2_title' => 'Marketing & Outils',
            'skills_graphism' => [
                ['name' => 'Suite Adobe (Illustrator, InDesign, Photoshop)', 'percentage' => 95],
                ['name' => 'Premiere Pro', 'percentage' => 85],
                ['name' => 'WordPress', 'percentage' => 90],
            ],
            'skills_marketing' => [
                ['name' => 'Salesforce (CRM)', 'percentage' => 90],
                ['name' => 'Microsoft Office', 'percentage' => 95],
                ['name' => 'Canva', 'percentage' => 80],
            ],

            // Outils et centres d'intérêt
            'tools_section_title' => 'Outil',
            'interests_section_title' => 'Centres d\'intérêt',
            'tools_list' => [
                'Suite Adobe (Illustrator, InDesign, Photoshop, Premiere Pro)',
                'Marketing & Communication (Salesforce, Wordpress, E-mailing)',
                'Suite Microsoft Office',
                'Canva',
                'Sponsoring',
            ],
            'interests_list' => [
                'Voyages (Amérique du Nord, Asie)',
                'Randonnée (trekking)',
                'Littérature',
            ],

            // Formations et expériences
            'education_section_title' => 'Formations',
            'experience_section_title' => 'Expériences',
            'education_items' => [
                [
                    'period' => '2020 - 2022',
                    'school' => 'ESUPCOM',
                    'degree' => 'Master Communication des entreprises & des organisations',
                ],
                [
                    'period' => '2017 - 2020',
                    'school' => 'YNOV Campus',
                    'degree' => 'Bachelor Communication & Marketing digital',
                ],
                [
                    'period' => '2019',
                    'school' => 'Dublin Business School',
                    'degree' => 'Communication & Management',
                ],
            ],
            'experience_items' => [
                [
                    'period' => '2022 - Présent',
                    'company' => 'Pellenc ST',
                    'position' => 'Chargée Marketing',
                ],
                [
                    'period' => '2019 - 2022',
                    'company' => 'RIDERVALLEY',
                    'position' => 'Alternante Chargée Communication',
                ],
                [
                    'period' => 'Mai - Août 2019',
                    'company' => 'ILLUSIO',
                    'position' => 'Stage Community Manager',
                ],
                [
                    'period' => 'Juil - Août 2018',
                    'company' => 'SFC',
                    'position' => 'Stage Chargée de communication',
                ],
            ],

            // CV
            'cv_file' => 'img/CV_22.08.jpg',
        ]);
    }
}
