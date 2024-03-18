<?php

namespace App\Http\Livewire\Traits;

trait Maskable
{
    public function applyMasks()
    {
        $mask = $this->getDocumentMask();
        $contactMask = $this->getContactMask();

        if (!is_null($mask)) {
            $this->dispatchMaskEvent($mask);
        }
        if (!is_null($contactMask)) {
            $this->dispatchContactMaskEvent($contactMask);
        }
    }

    protected function dispatchMaskEvent(mixed $mask): void
    {
        $this->dispatchBrowserEvent('change-mask', [
            'ref' => 'document_number',
            'mask' => $mask,
        ]);
    }

    protected function dispatchContactMaskEvent(mixed $mask): void
    {
        $this->dispatchBrowserEvent('change-contact-mask', [
            'ref' => 'contact',
            'mask' => $mask,
        ]);
    }

    public function getDocumentMask()
    {
        $documentType = $this->document_type_id ?? null;

        switch ($documentType) {
            case 1:
                return '999.999.999-99';
            default:
                return '';
        }
    }

    public function getContactMask()
    {
        $contactType = $this->contact_type_id ?? null;

        switch ($contactType) {
            case 1:
                return '(99) 99999-9999';
            case 2:
                return '(99) 9999-9999';
            default:
                return '';
        }
    }
}
