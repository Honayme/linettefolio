<?php

namespace App\Livewire;

use App\Models\AboutContent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RomanZipp\Seo\Facades\Seo;
use Spatie\SchemaOrg\Schema;

class About extends Component
{
    public $content;

    public function mount()
    {
        $this->content = AboutContent::first();

        // Créer un contenu par défaut si aucun n'existe
        if (!$this->content) {
            $this->content = new AboutContent([
                'title' => 'À propos',
                'subtitle' => 'Découvrez mon parcours',
                'hero_image' => null,
                'hero_image_alt' => 'Description pertinente de l\'image',
            ]);
        }

        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $title = 'À Propos - ' . ($this->content->full_name ?? 'Lina-Marie MICHEL');
        $description = $this->content->description ?? 'Découvrez le parcours de Lina-Marie MICHEL, spécialiste en marketing digital et communication avec plus de 6 ans d\'expérience. Passionnée par les projets multiculturels et le design graphique.';
        $url = route('about');
        $siteName = 'Linettefolio';
        $authorName = $this->content->full_name ?? 'Lina-Marie MICHEL';
        $jobTitle = $this->content->job_title ?? 'Marketing & Communication';
        $image = $this->content->hero_image ? asset('storage/' . $this->content->hero_image) : asset('img/logo/dark.png');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->meta('keywords', 'Lina-Marie MICHEL, à propos, parcours professionnel, marketing digital, communication, expérience, compétences')
            ->meta('author', $authorName)
            ->meta('robots', 'index,follow')
            ->meta('language', 'fr-FR')

            // Open Graph
            ->meta('og:type', 'profile')
            ->meta('og:title', $title)
            ->meta('og:description', $description)
            ->meta('og:url', $url)
            ->meta('og:site_name', $siteName)
            ->meta('og:image', $image)
            ->meta('og:image:alt', $this->content->hero_image_alt ?? 'Photo de profil de ' . $authorName)
            ->meta('og:locale', 'fr_FR')
            ->meta('profile:first_name', explode(' ', $authorName)[0] ?? 'Lina-Marie')
            ->meta('profile:last_name', explode(' ', $authorName)[1] ?? 'MICHEL')

            // Twitter Card
            ->meta('twitter:card', 'summary_large_image')
            ->meta('twitter:title', $title)
            ->meta('twitter:description', $description)
            ->meta('twitter:image', $image)
            ->meta('twitter:image:alt', $this->content->hero_image_alt ?? 'Photo de profil de ' . $authorName)

            // Schema.org
            ->addSchema(
                Schema::aboutPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->mainEntity(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle($jobTitle)
                            ->description($description)
                            ->url($url)
                            ->image($image)
                            ->worksFor(
                                Schema::organization()
                                    ->name('Pellenc ST')
                                    ->description('Entreprise spécialisée dans les technologies environnementales')
                            )
                            ->alumniOf([
                                Schema::educationalOrganization()
                                    ->name('Formation Marketing Digital')
                                    ->description('Spécialisation en marketing digital et communication')
                            ])
                            ->knowsAbout([
                                'Marketing Digital',
                                'Communication',
                                'Design Graphique',
                                'Community Management',
                                'Gestion de Projets',
                                'Équipes Multiculturelles'
                            ])
                    )
                    ->author(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle($jobTitle)
                    )
            );
    }

    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.about');
    }
}
