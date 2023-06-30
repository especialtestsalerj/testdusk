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
    public $visitorId;

    public function mount($id)
    {
        $visitor = Visitor::select('visitors.*', 'people.full_name', 'documents.number as document', 'sectors.name as sector')
            ->where('visitors.id', '=', $id)
            ->join('people', 'people.id', '=', 'visitors.person_id')
            ->join('documents', 'documents.id', '=', 'visitors.document_id')
            ->join('sectors', 'sectors.id', '=', 'visitors.sector_id')
            ->first();
            
        $this->visitorId = $visitor->id;
        $this->name = $visitor->full_name;
        $this->document = $visitor->document;
        $this->sector = $visitor->sector;
        $this->reason = $visitor->description;
        $this->entranced = $visitor->entranced_at;
        $this->exited = now()->format('Y-m-d\TH:i');
    }

    public function finishVisit()
    {
        $visitor = Visitor::find($this->visitorId);
        $visitor->exited_at = $this->exited;
        $visitor->save();
        session()->flash('message', 'Visita finalizada com sucesso');
        return redirect()->route('visitors.index');
    }

    public function render()
    {
        return view('livewire.visitors.visitors-card', [
            'name' => $this->name,
            'document' => $this->document,
            'sector' => $this->sector,
            'reason' => $this->reason,
            'entranced' => $this->entranced,
            'exited' => $this->exited,
        ]);
    }
}
