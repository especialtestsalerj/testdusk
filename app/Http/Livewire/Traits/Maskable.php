<?php

namespace App\Http\Livewire\Traits;

trait Maskable
{
    public function applyMasks()
    {
        $mask = $this->getDocumentMask();
        if (!is_null($mask)) {
            $this->dispatchMaskEvent($mask);
        }
    }

    protected function dispatchMaskEvent(mixed $mask): void
    {
        $this->dispatchBrowserEvent('change-mask', [
            'ref' => 'document_number',
            'mask' => $mask,
        ]);
    }

    public function getDocumentMask()
    {
        $documentType = $this->document_type_id;

        switch ($documentType) {
            case 1:
                return '999.999.999-99';
            default:
                return '';
        }
    }
}
