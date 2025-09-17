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
    }

    #[Layout('layouts.app')]
    public function render(): Factory|Application|View
    {
        return view('livewire.about');
    }
}
