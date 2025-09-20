<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Service as ServiceModel;
use RomanZipp\Seo\Facades\Seo;
use Spatie\SchemaOrg\Schema;

class Service extends Component
{
    public $services;

    public function mount(): void
    {
        $this->services = ServiceModel::orderBy('display_order', 'asc')->get();
        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $title = 'Services - Lina-Marie MICHEL | Marketing Digital & Communication';
        $description = 'Découvrez mes services en marketing digital, communication, design graphique et community management. Solutions personnalisées pour développer votre présence digitale et atteindre vos objectifs.';
        $url = route('services');
        $siteName = 'Linettefolio';
        $authorName = 'Lina-Marie MICHEL';
        $image = asset('img/logo/dark.png');

        // Créer une liste des services pour les mots-clés et la description
        $servicesList = $this->services->pluck('title')->implode(', ');
        $servicesKeywords = $this->services->pluck('title')->map(fn($title) => strtolower($title))->implode(', ');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->meta('keywords', "services, $servicesKeywords, marketing digital, communication, design graphique, Lina-Marie MICHEL, prestations")
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
            ->meta('og:image:alt', 'Services de Lina-Marie MICHEL en marketing digital')
            ->meta('og:locale', 'fr_FR')

            // Twitter Card
            ->meta('twitter:card', 'summary_large_image')
            ->meta('twitter:title', $title)
            ->meta('twitter:description', $description)
            ->meta('twitter:image', $image)
            ->meta('twitter:image:alt', 'Services de Lina-Marie MICHEL en marketing digital')

            // Schema.org - Services
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(
                        Schema::person()
                            ->name($authorName)
                            ->jobTitle('Spécialiste Marketing Digital & Communication')
                    )
                    ->mainEntity(
                        Schema::itemList()
                            ->name('Services Proposés')
                            ->description('Liste des services en marketing digital et communication')
                            ->itemListElement(
                                $this->services->map(function ($service, $index) use ($url) {
                                    return Schema::listItem()
                                        ->position($index + 1)
                                        ->item(
                                            Schema::service()
                                                ->name($service->title)
                                                ->description($service->excerpt)
                                                ->provider(
                                                    Schema::person()
                                                        ->name('Lina-Marie MICHEL')
                                                        ->jobTitle('Spécialiste Marketing Digital & Communication')
                                                )
                                                ->serviceType('Marketing Digital & Communication')
                                                ->url($url)
                                        );
                                })->toArray()
                            )
                    )
            );

        // Ajouter un schema Organization pour les services
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
                ->hasOfferCatalog(
                    Schema::offerCatalog()
                        ->name('Catalogue de Services')
                        ->itemListElement(
                            $this->services->map(function ($service) {
                                return Schema::offer()
                                    ->name($service->title)
                                    ->description($service->excerpt)
                                    ->category('Marketing Digital & Communication');
                            })->toArray()
                        )
                )
        );
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.service');
    }
}
