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
                // Si le layout est VIDEO ou PRESENTATION, la source est l'URL de la vidéo.
                PortfolioLayout::VIDEO, PortfolioLayout::PRESENTATION => $item->video_url,
                PortfolioLayout::SLIDER => collect($item->images)->map(fn($img) => asset('storage/' . $img))->all(),
                default => asset('storage/' . ($item->images[0] ?? $item->cover_image)),            };

            return [
                'id' => $item->id,
                'coverSrc' => asset('storage/' . $item->cover_image),
                'mediaType' => $item->layout->value,
                'mediaSrc' => $mediaSrc,
                'alt' => $item->cover_image_alt,
                'tags' => $item->categories->pluck('name')->all(),
            ];
        })->all();
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
