<?php

namespace App\Livewire;

use App\Models\AboutContent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
    }

    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.about');
    }
}
