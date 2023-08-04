<?php

namespace App\Http\Livewire\Traits;

use App\Data\Repositories\Visitors;
use App\Data\Repositories\Visitors as VisitorsRepository;
use App\Models\Visitor;

trait Badgeable
{
    public $printVisitor;
    public function  generateBadge($visitor_id)
    {

        $this->printVisitor = null;

        if (!empty($visitor_id)) {
            $this->printVisitor = app(VisitorsRepository::class)->findById([$visitor_id]);
        } else {
            $this->loadAnonymousVisitor();
        }

        $this->printVisitor->append(['photo','qr_code_uri']);

        $this->dispatchBrowserEvent('printBadge');
    }

    private function loadAnonymousVisitor()
    {
        $this->printVisitor = app(Visitors::class)->getAnonymousVisitor();

    }

}
