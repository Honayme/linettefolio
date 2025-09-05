<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Service as ServiceModel;

class Service extends Component
{
    public $services;

    public function mount(): void
    {
        $this->services = ServiceModel::orderBy('display_order', 'asc')->get();
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.service');
    }
}
