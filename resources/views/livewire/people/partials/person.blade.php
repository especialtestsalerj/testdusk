<div class="form-group">
    <div x-init="//VMasker($refs.cpf).maskPattern(cpfmask);

    Webcam.attach('#webcam');

    window.take_snapshot = function() {
        window.Webcam.snap(function(data_uri) {
            const fileInput = document.querySelector('input[type=file]');
            const myFile = base64ToFile(data_uri, 'webcam-picture.jpg');

            // Now let's create a DataTransfer to get a FileList
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(myFile);
            fileInput.files = dataTransfer.files;

            var inputEvent = new Event('input');
            fileInput.dispatchEvent(inputEvent);
            var changeEvent = new Event('change');
            fileInput.dispatchEvent(changeEvent);
        });
    }" x-data="{ isEditing: {{ !$modal ? 'true' : 'false' }}, cpfmask: '999.999.999-99' }" @focus-field.window="$refs[$event.detail.field].focus()">

        <div class="row">
            <div class="col-12">
                <h4>
                    Dados do/a Visitante
                </h4>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="document_type_id">Tipo de Documento*</label>
                    <select name="document_type_id" class="form-control text-uppercase"
                            wire:model="document_type_id" @if ($modal) disabled @endif
                            @if ($readonly) readonly @endif x-ref="document_type_id">
                        <option value="">Selecione</option>
                        @foreach ($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input name="person_id" type="hidden" wire:model.defer="person_id">

            <div class="col-lg-4 col-xl-4">
                <div class="form-group">
                    <input name="document_number" id="document_number" type="hidden" wire:model.defer="document_number">
                    <label for="document_number">Documento*</label>
                    <input @if ($modal) disabled @endif
                    @if ($readonly) readonly @endif type="text"
                           class="form-control @error('cpf') is-invalid @endError" name="document_number"
                           id="document_number" wire:model.lazy="document_number" x-ref="document_number"
                           wire:blur="searchDocumentNumber" />
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                @if($document_type_id == 2)
                    <div class="form-group">
                        <label for="state_document_id">UF do Documento*</label>
                        <select name="state_document_id" class="select2 form-control text-uppercase" id="state_document_id"
                                wire:model="state_document_id" x-ref="state_document_id"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">SELECIONE</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->initial }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="full_name">Nome Completo*</label>
                    <input type="text" class="form-control text-uppercase" name="full_name"
                           id="full_name" wire:model.debounce.500ms="full_name"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif />
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="social_name">Nome Social</label>
                    <input type="text" class="form-control text-uppercase" name="social_name"
                           id="social_name" wire:model="social_name"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif />
                </div>
            </div>

            <div class="col-lg-6 col-xl-6" wire:ignore>
                <div class="form-group">
                    <label for="country_id">País*</label>
                    <select name="country_id" class="select2 form-control text-uppercase" id="country_id"
                            wire:model="country_id" x-ref="country_id"
                            @if ($modal) disabled @endif
                            @if ($readonly) readonly @endif>
                        <option value="">SELECIONE</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($this->detectIfCountryBrSelected())
                <div class="col-lg-6 col-xl-6" wire:ignore id="div-state_id">
                    <div class="form-group">
                        <label for="state_id">Estado*</label>
                        <select class="select2 form-control text-uppercase" id="state_id" name="state_id"
                                wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">SELECIONE</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->initial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6" wire:ignore id="div-city_id">
                    <div class="form-group">
                        <label for="city_id">Cidade*</label>
                        <select name="city_id" id="city_id" class="select2 form-control text-uppercase"
                                wire:model="city_id" x-ref="city_id"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">SELECIONE</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id ?? $city['id'] }}">{{ mb_strtoupper($city->name ?? $city['name']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endIf

            @if(!$this->detectIfCountryBrSelected())
                <div class="col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="other_city">Cidade*</label>
                        <input type="text" name="other_city" class="form-control text-uppercase"
                               value="{{ $other_city }}"
                               @if ($modal) disabled @endif
                               @if ($readonly) readonly @endif />
                    </div>
                </div>
            @endIf
        </div>

        <div class="row">
            @error('cpf')
                <small class="text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </small>
            @endError
            @foreach ($alerts as $alert)
                <small class="text-danger">
                    <i class="fas fa-cancel"></i>
                    {{ $alert }}
                </small>
            @endforeach
        </div>

    </div>
</div>
