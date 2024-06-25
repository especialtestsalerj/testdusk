<?php

namespace App\Http\Livewire\Events;

use App\Data\Repositories\Events as EventsRepository;
use App\Data\Repositories\EventTypes as EventTypesRepository;
use App\Data\Repositories\Routines as RoutinesRepository;
use App\Data\Repositories\Sectors as SectorsRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Livewire\BaseForm;
use App\Http\Livewire\Traits\Swallable;
use App\Models\AttachedFile;
use App\Support\Constants;
use Livewire\WithFileUploads;

class Form extends BaseForm
{
    use WithFileUploads, Swallable;

    public $description;
    public $duty_user_id;
    public $sector_id;
    public $event_type_id;
    public $occurred_at;
    public $routine_id;
    public $routine;
    public $event;
    public $formMode;
    public $files = [];
    public $selectedAttachmentId;

    protected $listeners = [
        'confirm-remove' => 'confirmRemove',
        'refreshForm' => '$refresh',
    ];

    public function mount($routine_id, $id = null)
    {
        $this->routine_id = $routine_id;
        $this->routine = app(RoutinesRepository::class)->findById($routine_id);

        if ($id) {
            $this->formMode = Constants::FORM_MODE_SHOW;
            $this->loadEvent($id);

        } else {
            $this->formMode = Constants::FORM_MODE_CREATE;
            $this->initializeNewEvent();
        }
    }

    protected function loadEvent($id)
    {
        $this->event = app(EventsRepository::class)->findById($id);
        $this->fillAttributes($this->event);
    }

    protected function initializeNewEvent()
    {
        $this->event = app(EventsRepository::class)->new();
        $this->fillAttributes();
    }

    public function preventRemoveDocument($attachedFileId)
    {
        $this->selectedAttachmentId = $attachedFileId;
        $this->emitSwall('Deseja Realmente Remover o Anexo da Ocorrência?',
            'A ação não pode ser desfeita', 'confirm-remove', 'delete');
    }

    protected function fillAttributes($event = null)
    {
        $this->fill([
            'description' => old('description', $event->description ?? ''),
            'duty_user_id' => old('duty_user_id', $event->duty_user_id ?? null),
            'sector_id' => old('sector_id', $event->sector_id ?? null),
            'event_type_id' => old('event_type_id', $event->event_type_id ?? null),
            'occurred_at' => old('occurred_at', $event?->occurred_at->format('Y-m-d\TH:i') ?? null),
        ]);
    }


    public function confirmRemove()
    {
        if (!is_null($this->selectedAttachmentId)) {
            $attachedFile = AttachedFile::find($this->selectedAttachmentId);
            if ($attachedFile) {
                $attachedFile->delete();
            }
            $this->emit('refreshForm');
        }
    }

    public function render()
    {
        return view('livewire.events.form', [
            'routine_id' => $this->routine_id,
            'routine' => $this->routine,
            'event' => $this->event,
            'eventTypes' => app(EventTypesRepository::class)->allActive(),
            'sectors' => app(SectorsRepository::class)->allActive(),
            'users' => app(UsersRepository::class)
                ->disablePagination()
                ->all()]);
    }
}
