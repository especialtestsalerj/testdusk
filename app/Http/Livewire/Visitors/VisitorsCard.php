<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Visitor;
use Livewire\Component;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Visitor as VisitorModel;
use App\Data\Repositories\Visitors as VisitorsRepository;

class VisitorsCard extends Component
{
    public $name;
    public $document;
    public $sector;
    public $reason;
    public $entranced;
    public $exited;
    public $visitorId;
    public $visitorPhoto;
    public $alreadyExited;

    public function mount($uuid = null)
    {
        if ($uuid) {
            if (Uuid::isValid($uuid)) {
                $visitor = VisitorModel::where('uuid', $uuid)->firstOrFail();
            } else {
                abort(404);
            }
        } else {
            if ($timestamp = request()->query('timestamp')) {
                $visitor = app(VisitorsRepository::class)->getAnonymousVisitor(
                    Carbon::createFromTimestamp($timestamp)
                );
            } else {
                abort(404);
            }
        }

        if ($visitor->exited_at) {
            $this->alreadyExited = true;
            $this->exited = $visitor->exited_at->format('Y-m-d\TH:i');
        } else {
            if (auth()->user()?->can('visitors:checkout')) {
                $this->exited = now()->format('Y-m-d\TH:i');
            } else {
                $this->exited = null;
            }
            $this->alreadyExited = false;
        }

        $this->visitorId = $visitor->id ?? '';
        $this->name = $visitor->person->full_name ?? '';
        $this->document = $visitor->document ?? '';
        $this->sector = $visitor->sector ?? '';
        $this->reason = $visitor->description ?? '';
        $this->entranced = $visitor->entranced_at;
        $this->visitorPhoto = $visitor->photo;
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
        return view('livewire.visitors.visitors-card');
    }
}
