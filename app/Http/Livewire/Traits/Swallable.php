<?php

namespace App\Http\Livewire\Traits;

trait Swallable
{
    public function emitSwall($title, $text, $confirmEvent, $action)
    {
        $this->dispatchBrowserEvent('swal', [
            'title' => $title,
            'text' => $text,
            'confirmEvent' => $confirmEvent,
            'action' => $action,
        ]);
    }
}
