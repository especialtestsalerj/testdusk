<?php

namespace App\Http\Livewire\Visitors;

use App\Models\Visitor;
use App\Models\Visitor as VisitorModel;
use Livewire\Component;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Card as CardModel;
use App\Data\Repositories\Visitors as VisitorsRepository;

class VisitorsCard extends Component
{
    public $name;
    public $card;
    public $document;
    public $sectors;
    public $reason;
    public $entranced;
    public $exited;
    public $visitorId;
    public $visitorPhoto;
    public $alreadyExited;

    public $exitedDisabled;
    public $showSaveButton;

    protected function visitorsRoute()
    {
        return \Request::route()->getName() == 'visitors.card';
    }
    public function mount($uuid = null)
    {
        if ($uuid) {
            if (Uuid::isValid($uuid)) {
                if ($this->visitorsRoute()) {
                    $visitor = VisitorModel::where('uuid', $uuid)->firstOrFail();
                } else {
                    $visitor = (CardModel::where('uuid', $uuid)->firstOrFail())->visitors[0];
                    if (!$visitor) {
                        abort(400, 'Cartão não possui visita em aberto');
                    }
                }
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

        $this->card = $visitor->card?->number ?? '';
        $this->visitorId = $visitor->id ?? '';
        $this->name = $visitor->person->name ?? '';
        $this->document = $visitor->document ?? '';
        $this->sectors = $visitor->sectors ?? '';
        $this->reason = $visitor->description ?? '';
        $this->entranced = $visitor->entranced_at;
        $this->visitorPhoto = $visitor->photo;

        $this->initializeExited($visitor);
    }

    public function initializeExited($visitor)
    {
        if ($visitor->exited_at) {
            $this->alreadyExited = true;
            $this->exited = $visitor->exited_at->format('Y-m-d\TH:i');
        } else {
            if (
                auth()
                    ->user()
                    ?->can(make_ability_name_with_current_building('visitors:checkout')) &&
                $this->visitorId
            ) {
                $this->exited = now()->format('Y-m-d\TH:i');
            } else {
                $this->exited = null;
            }
            $this->alreadyExited = false;
        }

        $this->showSaveButton =
            $this->visitorId &&
            (auth()
                ->user()
                ?->can(make_ability_name_with_current_building('visitors:checkout')) &&
                !$this->alreadyExited);

        $this->exitedDisabled =
            !$this->visitorId ||
            (!auth()
                ->user()
                ?->can(make_ability_name_with_current_building('visitors:checkout')) ||
                $this->alreadyExited);
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
        return view('visitors.partials.visitors-card');
    }
}
