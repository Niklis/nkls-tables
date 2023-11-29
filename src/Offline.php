<?php

namespace Nkls\Tables;

use Livewire\Component;

class Offline extends Component
{
    public function render()
    {
        return <<<'blade'
        <div wire:offline class="text-center text-danger bg-dark">Please check your internet connection.</div>
        blade;
    }
}
