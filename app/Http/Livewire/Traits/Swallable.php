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

    public function swallError($text)
    {
        $this->dispatchBrowserEvent('swall-error', [
            'text' => $text,
        ]);
    }

    public function swallSuccess($text)
    {
        $this->dispatchBrowserEvent('swall-success',[
            'text'=>$text
        ]);
    }

    public function swalConfirmation($title, $text, $route)
    {
        $this->dispatchBrowserEvent('swal-confirmation',[
            'title' => $title,
            'text' => $text,
            'route' => $route,
        ]);
    }
}
