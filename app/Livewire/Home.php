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
    }

    #[Layout('layouts.app')]
    public function render() : Factory|Application|View
    {
        return view('livewire.home');
    }
}
