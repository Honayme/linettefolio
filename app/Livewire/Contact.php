<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RomanZipp\Seo\Facades\Seo;
use Spatie\SchemaOrg\Schema;

class Contact extends Component
{
    public function mount(): void
    {
        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $title = 'Contact - Lina-Marie MICHEL | Parlons de vos projets';
        $description = 'Contactez Lina-Marie MICHEL pour discuter de vos projets en marketing digital et communication. Prenons rendez-vous pour développer ensemble votre stratégie digitale et atteindre vos objectifs.';
        $url = route('contact');
        $siteName = 'Linettefolio';
        $authorName = 'Lina-Marie MICHEL';
        $image = asset('img/logo/dark.png');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->meta('keywords', 'contact, Lina-Marie MICHEL, devis, consultation, marketing digital, communication, projet, collaboration, rendez-vous')
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
            ->meta('og:image:alt', 'Contactez Lina-Marie MICHEL pour vos projets')
            ->meta('og:locale', 'fr_FR')

            // Twitter Card
            ->meta('twitter:card', 'summary_large_image')
            ->meta('twitter:title', $title)
            ->meta('twitter:description', $description)
            ->meta('twitter:image', $image)
            ->meta('twitter:image:alt', 'Contactez Lina-Marie MICHEL pour vos projets')

            // Schema.org - ContactPage
            ->addSchema(
                Schema::contactPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle('Spécialiste Marketing Digital & Communication')
                    )
                    ->mainEntity(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle('Spécialiste Marketing Digital & Communication')
                            ->description('Experte en marketing digital et communication, disponible pour vos projets et collaborations')
                            ->url($url)
                            ->contactPoint(
                                Schema::contactPoint()
                                    ->contactType('customer service')
                                    ->availableLanguage(['French', 'English'])
                                    ->areaServed('France')
                                    ->hoursAvailable([
                                        Schema::openingHoursSpecification()
                                            ->dayOfWeek(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])
                                            ->opens('09:00')
                                            ->closes('18:00')
                                    ])
                            )
                            ->knowsAbout([
                                'Marketing Digital',
                                'Communication',
                                'Design Graphique',
                                'Community Management',
                                'Stratégie Digitale',
                                'Gestion de Projets'
                            ])
                    )
            );

        // Ajouter un schema Organization pour le contact professionnel
        seo()->addSchema(
            Schema::organization()
                ->name($siteName)
                ->description('Services professionnels en marketing digital et communication')
                ->url($url)
                ->founder(
                    Schema::person()
                        ->name($authorName)
                        ->jobTitle('Spécialiste Marketing Digital & Communication')
                )
                ->contactPoint(
                    Schema::contactPoint()
                        ->contactType('customer service')
                        ->availableLanguage(['French', 'English'])
                        ->areaServed('France')
                )
                ->areaServed(
                    Schema::country()
                        ->name('France')
                )
        );
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.contact');
    }
}
