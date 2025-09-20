<?php

namespace App\Livewire;

use App\Models\HomeContent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RomanZipp\Seo\Structs\Meta;
use RomanZipp\Seo\Structs\Meta\OpenGraph;
use RomanZipp\Seo\Structs\Meta\Twitter;
use RomanZipp\Seo\Structs\Struct;
use RomanZipp\Seo\Facades\Seo;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    public $content;

    public function mount()
    {
        $this->content = HomeContent::first();

        // Créer un contenu par défaut si aucun n'existe
        if (!$this->content) {
            $this->content = new HomeContent([
                'hero_title' => 'Bienvenue',
                'hero_subtitle' => 'Portfolio créatif',
                'hero_image' => null,
                'hero_image_alt' => 'Hero image',
            ]);
        }

        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $title = $this->content->hero_title ?? 'Lina-Marie MICHEL - Portfolio Créatif';
        $description = $this->content->hero_subtitle ?? 'Découvrez le portfolio créatif de Lina-Marie MICHEL, spécialiste en marketing digital et communication. Explorez mes projets, services et réalisations.';
        $url = route('home');
        $siteName = 'Linettefolio';
        $authorName = 'Lina-Marie MICHEL';
        $image = $this->content->hero_image ? asset('storage/' . $this->content->hero_image) : asset('img/logo/dark.png');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->meta('keywords', 'Lina-Marie MICHEL, portfolio, marketing digital, communication, design graphique, projets créatifs')
            ->meta('author', $authorName)
            ->meta('robots', 'index,follow')
            ->meta('language', 'fr-FR')

            // Open Graph
            ->meta('og:type', 'website')
            ->meta('og:title', $title)
            ->meta('og:description', $description)
            ->meta('og:url', $url)
            ->meta('og:site_name', $siteName)
            ->meta('og:image', $image)
            ->meta('og:image:alt', $this->content->hero_image_alt ?? 'Portfolio de Lina-Marie MICHEL')
            ->meta('og:locale', 'fr_FR')

            // Twitter Card
            ->meta('twitter:card', 'summary_large_image')
            ->meta('twitter:title', $title)
            ->meta('twitter:description', $description)
            ->meta('twitter:image', $image)
            ->meta('twitter:image:alt', $this->content->hero_image_alt ?? 'Portfolio de Lina-Marie MICHEL')

            // Schema.org
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle('Spécialiste Marketing Digital & Communication')
                            ->url($url)
                    )
                    ->publisher(
                        Schema::organization()
                            ->name($siteName)
                            ->url($url)
                    )
                    ->mainEntity(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle('Spécialiste Marketing Digital & Communication')
                            ->description('Experte en marketing digital et communication avec plus de 6 ans d\'expérience')
                            ->url($url)
                            ->sameAs([
                                // Ajouter les liens réseaux sociaux si disponibles
                            ])
                    )
            );
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.home');
    }
}
