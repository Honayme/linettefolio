<?php

namespace App\Livewire;

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
    /**
     * @var Collection
     */
    public $categories;

    /**
     * @var Collection
     */
    public $portfolioItems;

    /**
     * Prépare les données initiales lors du chargement du composant.
     * C'est ici que nous allons chercher toutes les informations
     * nécessaires dans la base de données.
     *
     * @return void
     */
    public function mount(): void
    {
        // 1. Récupérer les catégories pour le menu de filtre.
        // On prend seulement les catégories parentes (celles à la racine)
        // et on charge leurs enfants en même temps pour optimiser.
        $this->categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('order_column')
            ->get();

        // 2. Récupérer tous les portfolio items qui sont visibles.
        // On charge leurs catégories associées pour pouvoir générer les classes de filtre.
        // On les trie par les plus récents en premier.
        $this->portfolioItems = PortfolioItem::where('is_visible', true)
            ->with('categories')
            ->latest() // Raccourci pour orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * Affiche la vue du composant.
     * Les propriétés publiques ($categories, $portfolioItems) sont
     * automatiquement disponibles dans cette vue.
     *
     * @return Factory|Application|View
     */
    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.portfolio');
    }
}
