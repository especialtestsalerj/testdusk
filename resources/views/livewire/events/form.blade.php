<div class="py-4 px-4">
    <form name="formulario" id="formulario" enctype="multipart/form-data"
          @if($formMode == 'show') action="{{ route('events.update', ['routine_id' => $routine_id, 'id' => $event->id]) }}"
          @else action="{{ route('events.store', ['routine_id' => $routine_id])}}" @endIf method="POST">
        @csrf

        @if (isset($event))
            <input type="hidden" name="id" value="{{ $event->id }}">
        @endif
        <input type="hidden" name="routine_id" value="{{ $routine_id }}">
        <input type="hidden" name="redirect" value="routines.show">

        <div class="">
            <div class="row">
                <div class="col-sm-8 align-self-center">
                    <h3 class="mb-0">
                        @if(is_null($event->id))
                            <a href="{{ route('routines.show', ['id' => $routine_id]) }}">Ocorrências</a>
                            > Nova
                        @else
                            <a href="{{ route('routines.show', ['routine_id' => $routine_id, 'id' => $event->id]) }}">Ocorrências</a>
                            > {{ $event->id }} - {{ $event->occurred_at->format('d/m/Y \À\S H:i') }}
                        @endif
                    </h3>
                </div>

                <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                    @include('partials.save-button', ['model' => $event, 'backUrl' => 'routines.show', 'permission' => ($routine->status && !request()->query('disabled') ? ($formMode == 'show' ? make_ability_name_with_current_building('events:update') : make_ability_name_with_current_building('events:store')) : ''), 'id' => $routine_id])
                </div>
            </div>
        </div>

        <div class="card-body my-2">
            @include('layouts.msg')
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="occurred_at">Data da Ocorrência*</label>
                        <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase"
                               name="occurred_at" id="occurred_at" wire:model.defer="occurred_at"
                               value="{{ is_null(old('occurred_at')) ? ($formMode == 'create' ? date('Y-m-d H:i') : $event->occurred_at_formatted) : old('occurred_at') }}" @disabled(!$routine->status || request()->query('disabled'))/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" wire:ignore>
                        <label for="event_type_id">Tipo*</label>
                        <select class="select2 form-control" name="event_type_id" id="event_type_id"
                                wire:model.defer="event_type_id" @disabled(!$routine->status || request()->query('disabled'))>
                            <option value="">SELECIONE</option>
                            @foreach ($eventTypes as $key => $eventType)
                                @if(((!is_null($event->id)) && (!is_null($event->event_type_id) && $event->event_type_id === $eventType->id) || (!is_null(old('event_type_id'))) && old('event_type_id') == $eventType->id))
                                    <option value="{{ $eventType->id }}"
                                            selected="selected">{{ $eventType->name }}</option>
                                @else
                                    <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" wire:ignore>
                        <label for="sector_id">Setor</label>
                        <select class="select2 form-control" name="sector_id" id="sector_id"
                                wire:model.defer="sector_id" @disabled(!$routine->status || request()->query('disabled'))>
                            <option value="">&nbsp;</option>
                            @foreach ($sectors as $key => $sector)
                                @if(((!is_null($event->id)) && (!is_null($event->sector_id) && $event->sector_id === $sector->id) || (!is_null(old('sector_id'))) && old('sector_id') == $sector->id))
                                    <option value="{{ $sector->id }}" selected="selected">{{ $sector->name }}</option>
                                @else
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" wire:ignore>
                        <label for="duty_user_id">Plantonista*</label>
                        <select class="select2 form-control" name="duty_user_id" id="duty_user_id"
                                wire:model.defer="duty_user_id" @disabled(!$routine->status || request()->query('disabled'))>
                            <option value="">SELECIONE</option>
                            @foreach ($users as $key => $user)
                                @if(((!is_null($event->id)) && (!is_null($event->duty_user_id) && $event->duty_user_id === $user->id) || (!is_null(old('duty_user_id'))) && old('duty_user_id') == $user->id))
                                    <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Observações*</label>
                        <textarea class="form-control" name="description" id="description"
                                  wire:model.defer="description"
                                  rows="10" @disabled(!$routine->status || request()->query('disabled'))>{{ is_null(old('description')) ? $event->description: old('description') }}</textarea>
                    </div>

                    <div class="mb-2">
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >

                            <div class="col-12 pb-2">
                                <input type="file" wire:model="files" name="files[]" multiple @disabled(!$routine->status || request()->query('disabled'))>

                                <div x-show="isUploading" class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         x-bind:style="'width: ' + progress + '%'"
                                         aria-valuemin="0" aria-valuemax="100">
                                        <span x-text="progress + '%'"></span>
                                    </div>
                                </div>

                            </div>

                            @error('files.*')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError

                            @error('files')
                            <small class="text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError

                            @if(!empty($files))
                                <div class="col-12 pt-3">
                                    <span>Documentos Carregados:</span>
                                    <ul>
                                        @foreach($files as $file)
                                            <li>{{ $file->getClientOriginalName() }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="row mb-2 col-12">
                            @foreach($event->attachedFiles as $attachedFile)
                                <div class="col-6 pt-3">
                                    <h5><a href="{{$attachedFile->file->url}}"
                                           target="_blank">{{$attachedFile->original_name}}</a></h5>
                                </div>
                                <div class="col-6" wire:key="attached-file-{{$attachedFile->id}}">
                                    <button title="Remover Documento"
                                            @disabled(!$routine->status || request()->query('disabled'))
                                            class="btn btn-sm btn-micro btn-danger"
                                            wire:click.prevent="preventRemoveDocument({{$attachedFile->id}})"><span
                                            class="fa fa-trash"> </span></button>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
    </form>
</div>

