<?php

namespace App\Livewire;

use App\Enums\PortfolioLayout; // Important : Importer l'énumération
use App\Models\Category;
use App\Models\PortfolioItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use RomanZipp\Seo\Facades\Seo;
use Spatie\SchemaOrg\Schema;

class Portfolio extends Component
{
    /** @var Collection */
    public Collection $categories;

    /** @var Collection */
    public Collection $portfolioItems;

    /** @var array */
    public array $alpineCategories = [];

    /** @var array */
    public array $alpineItems = [];

    /**
     * Prépare les données pour la vue.
     *
     * @return void
     */
    public function mount(): void
    {

        $this->categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('order_column')
            ->get();

        $this->alpineCategories = $this->categories->map(function ($category) {
            return [
                'name' => $category->name,
                'subcategories' => $category->children->pluck('name')->all(),
            ];
        })->all();

        $this->portfolioItems = PortfolioItem::where('is_visible', true)
            ->with('categories')
            ->latest()
            ->get();

        $this->alpineItems = $this->portfolioItems->map(function (PortfolioItem $item) {

            $mediaSrc = match ($item->layout) {
                PortfolioLayout::VIDEO => $item->video_url,
                PortfolioLayout::IMAGE => collect($item->images)->map(fn($img) => asset('storage/' . $img))->all(),
                PortfolioLayout::PRESENTATION => asset('storage/' . $item->pdf_file)
            };


            return [
                'id' => $item->id,
                'coverSrc' => asset('storage/' . $item->cover_image),
                'mediaType' => $item->layout->value,
                'mediaSrc' => $mediaSrc,
                'alt' => $item->cover_image_alt,
                'tags' => $item->categories->pluck('name')->all(),
            ];
        })->all();

//        dd($this->alpineItems);

        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $title = 'Portfolio - Mes Projets | Lina-Marie MICHEL';
        $description = 'Explorez mes projets créatifs en marketing digital, design graphique et communication. Portfolio de réalisations variées incluant des présentations, designs et stratégies digitales innovantes.';
        $url = route('portfolio');
        $siteName = 'Linettefolio';
        $authorName = 'Lina-Marie MICHEL';
        $image = $this->portfolioItems->first()?->cover_image ?
                asset('storage/' . $this->portfolioItems->first()->cover_image) :
                asset('img/logo/dark.png');

        // Créer une liste des catégories pour les mots-clés
        $categoriesKeywords = $this->categories->pluck('name')->map(fn($name) => strtolower($name))->implode(', ');
        $projectsCount = $this->portfolioItems->count();

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->meta('keywords', "portfolio, projets, $categoriesKeywords, réalisations, design graphique, marketing digital, Lina-Marie MICHEL, créations")
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
            ->meta('og:image:alt', 'Portfolio créatif de Lina-Marie MICHEL')
            ->meta('og:locale', 'fr_FR')

            // Twitter Card
            ->meta('twitter:card', 'summary_large_image')
            ->meta('twitter:title', $title)
            ->meta('twitter:description', $description)
            ->meta('twitter:image', $image)
            ->meta('twitter:image:alt', 'Portfolio créatif de Lina-Marie MICHEL')

            // Schema.org - Portfolio/CreativeWork
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
                            ->name('Portfolio de Projets')
                            ->description("Collection de $projectsCount projets créatifs et professionnels")
                            ->numberOfItems($projectsCount)
                            ->itemListElement(
                                $this->portfolioItems->map(function ($item, $index) {
                                    return Schema::listItem()
                                        ->position($index + 1)
                                        ->item(
                                            Schema::creativeWork()
                                                ->name($item->title)
                                                ->description($item->description)
                                                ->creator(
                                                    Schema::person()
                                                        ->name('Lina-Marie MICHEL')
                                                        ->jobTitle('Spécialiste Marketing Digital & Communication')
                                                )
                                                ->image(asset('storage/' . $item->cover_image))
                                                ->keywords($item->categories->pluck('name')->toArray())
                                                ->genre($item->categories->pluck('name')->implode(', '))
                                                ->dateCreated($item->created_at->toISOString())
                                        );
                                })->toArray()
                            )
                    )
            );

        // Ajouter un schema pour chaque catégorie principale
        foreach ($this->categories as $category) {
            $categoryItems = $this->portfolioItems->filter(function ($item) use ($category) {
                return $item->categories->contains('name', $category->name);
            });

            if ($categoryItems->isNotEmpty()) {
                seo()->addSchema(
                    Schema::creativeWorkSeries()
                        ->name($category->name)
                        ->description("Projets de la catégorie {$category->name}")
                        ->url($url)
                        ->creator(
                            Schema::person()
                                ->name($authorName)
                                ->jobTitle('Spécialiste Marketing Digital & Communication')
                        )
                        ->hasPart(
                            $categoryItems->map(function ($item) {
                                return Schema::creativeWork()
                                    ->name($item->title)
                                    ->description($item->description)
                                    ->image(asset('storage/' . $item->cover_image));
                            })->toArray()
                        )
                );
            }
        }
    }


    /**
     * Affiche la vue du composant.
     *
     * @return Factory|Application|View
     */
    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.portfolio');
    }
}
