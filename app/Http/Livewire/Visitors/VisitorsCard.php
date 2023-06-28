<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Visitor;
use Livewire\Component;

class VisitorsCard extends Component
{
    public $name;
    public $document;
    public $sector;
    public $reason;
    public $entranced;
    public $exited;

  /*   public function name()
    {
      
    } */

    public function render()
    {
       /*  dd(app(Visitor::class)->first()); */
        return view('livewire.visitors.visitors-card');
    }
}
