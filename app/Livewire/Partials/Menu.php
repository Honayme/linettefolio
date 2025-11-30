<?php

namespace App\Livewire\Partials;

use App\Models\SiteSettings;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Menu extends Component
{
    public $siteSettings;

    public function mount(): void
    {
        // Charger les paramètres du site
        $this->siteSettings = SiteSettings::first();
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.partials.menu');
    }
}

