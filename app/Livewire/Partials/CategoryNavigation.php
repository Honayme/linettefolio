<?php

namespace App\Livewire\Partials;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Class CategoryNavigation
 *
 * Ce composant a pour unique rôle de charger la hiérarchie des catégories
 * de manière optimisée et de la passer à la vue Blade.
 */
class CategoryNavigation extends Component
{
    /**
     * @var Collection Contiendra les catégories de premier niveau avec leurs enfants pré-chargés.
     */
    public Collection $categories;

    /**
     * La méthode mount est appelée une seule fois lors de l'initialisation du composant.
     * C'est l'endroit idéal pour charger les données qui ne changeront pas.
     */
    public function mount(): void
    {
        $this->categories = Category::query()
            // 1. On ne sélectionne que les catégories principales (celles sans parent).
            ->whereNull('parent_id')
            // 2. On pré-charge la relation 'children' pour toutes les catégories trouvées.
            //    Ceci évite de faire une requête SQL par catégorie dans la vue (problème N+1).
            ->with('children')
            // 3. On ordonne les catégories principales selon leur 'order_column'.
            ->orderBy('order_column', 'asc')
            ->get();
    }

    /**
     * Rend la vue Blade associée au composant.
     *
     * @return Factory|Application|View : Factory|Application|View
     */
    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.partials.category-navigation');
    }
}
