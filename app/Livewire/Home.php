<?php

namespace App\Livewire;

use App\Models\HomeContent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.home');
    }
}
