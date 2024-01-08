<?php

namespace App\Http\Livewire;

trait WithResetPage
{
    public function updated($name, $value): void
    {
        if(in_array($name, self::$resetPageTarget ?? [], true)) {
            $this->resetPage();
        }
    }
}
