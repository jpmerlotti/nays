<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class AnamneseFormSheet extends Component implements HasForms
{
    use InteractsWithForms;

    private array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.anamnese-form-sheet');
    }
}
