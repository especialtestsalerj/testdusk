<?php

namespace App\Http\Livewire\Traits;

use App\Models\Visitor;

trait Checkoutable
{

    public $selectedVisitorId;
    public $checkoutTime;
    public function prepareForCheckout($id)
    {
        $this->selectedVisitorId = $id;
        $this->checkoutTime = now();
        $visitor = Visitor::find($id);

        $this->emitSwall(
            'Marcar a saída de '.$visitor->person->abbreviated_name.' para '.now()->format('d/m/Y H:i'),
            '',
            'confirm-checkout-visitor',
            'checkout'
        );
    }

    public function confirmCheckout()
    {
        $visitor = Visitor::find($this->selectedVisitorId);
        if ($visitor && !$visitor->exited_at) {
            $visitor->exited_at = $this->checkoutTime;
            $visitor->save();
        }
    }
}
