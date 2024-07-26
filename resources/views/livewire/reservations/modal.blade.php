<div
    x-init=""
    x-data=""
    @focus-field.window="if($refs[$event.detail.field]) {$refs[$event.detail.field].focus()}"
    @change-mask.window="
     setTimeout(() => {
        // console.log($event); console.log($refs[$event.detail.ref]);
        if($refs[$event.detail.ref]) {
            if($event.detail.mask){
                //console.log('changed mask of '+$refs[$event.detail.ref]+' to '+$event.detail.mask)
                VMasker($refs[$event.detail.ref]).maskPattern($event.detail.mask);
            }else{
                var fieldValue = $refs[$event.detail.ref].value;
                VMasker($refs[$event.detail.ref]).unMask();

                // Set the stored value back into the input field
                $refs[$event.detail.ref].value = fieldValue;
            }
         }

        }, 500);
     "
>
    <div wire:ignore.self class="modal fade modal-lg" id="reservation-modal"
         tabindex="-1" role="dialog"
         aria-labelledby="capacityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i>
                        @if(!isset($reservation))
                            Novo Agendamento
                        @else
                            Agendamento de {{json_decode($reservation->person)->full_name}}
                        @endif
                    </h5>
                    <button wire:click.prevent="cleanModal" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                        </div>
                    </div>
                    <form name="formulario" id="formulario" wire:submit.prevent="store">
                        @csrf
                        <style>
                            .flatpickr-calendar {
                                z-index: 1051; /* Ajuste o valor conforme necessário */
                            }
                        </style>

                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label for="sector_modal_id" style="margin-left: 10px;"
                                       class="form-label">Setor*</label>
                                <div>
                                    <select
                                        class="form-control text-uppercase @error('sector_modal_id') is-invalid @endError"
                                        name="sector_modal_id" id="sector_modal_id"
                                        wire:model="sector_modal_id" x-ref="sector_modal_id"
                                        wire:change="loadDates">

                                        <option value="">SELECIONE</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id ?? $sector['id']}}">
                                                {{ convert_case($sector->alias ?? $sector['alias'], MB_CASE_UPPER) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="sector_id" value="{{$this->sector_modal_id}}"
                                           wire:model="sector_modal_id"/>
                                </div>

                                <div>
                                    @error('sector_modal_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="reservation_date" style="margin-left: 10px;" class="form-label">Data da
                                    Visita *</label>

                                <input type="button"
                                       class="form-control  @error('reservation_date') is-invalid @endError"
                                       id="reservation_date"
                                       value="{{$this->reservation_date}}"
                                       wire:model="reservation_date"
                                       @if(!$sector_modal_id) disabled @endif
                                       x-ref="reservation_date">

                                <div>
                                    @error('reservation_date')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <input type="hidden" name="reservation_date" value="{{$this->reservation_date}}"
                                   wire:model="reservation_date"/>

                            <div class="form-group col-md-3">
                                <label for="capacity_id" style="margin-left: 10px;" class="form-label">Hora da
                                    Visita *</label>

                                <select class="form-control text-uppercase @error('capacity_id') is-invalid @endError"
                                        name="capacity_id" id="capacity_id"
                                        wire:model="capacity_id" x-ref="capacity_id"
                                        @if(!$reservation_date) disabled @endif
                                >

                                    <option value="">SELECIONE</option>
                                    @foreach ($this->capacities as $capacitiy)
                                        <option value="{{ $capacitiy->id ?? $capacitiy['id']}}">
                                            {{ $capacitiy->maximum_capacity ?? $capacitiy['maximum_capacity'] }}
                                        </option>
                                    @endforeach
                                </select>

                                <div>
                                    @error('capacity_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>

                            </div>


                            <div class="form-group col-12">
                                <label for="motive" style="margin-left: 10px;" class="form-label">Motivo da
                                    Visita*</label>
                                <textarea id="motive" name="motive"
                                          class="form-control @error('motive') is-invalid @endError"
                                          wire:model="motive">
                                    </textarea>

                                <div>
                                    @error('motive')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document_type_id">Tipo de Documento*</label>
                                    <select
                                        class="form-control text-uppercase @error('document_type_id') is-invalid @endError"
                                        name="document_type_id" id="document_type_id"
                                        wire:model.lazy="document_type_id" x-ref="document_type_id">
                                        <option value="">SELECIONE</option>
                                        <option value="1">CPF</option>
                                        <option value="2">Passaporte</option>
                                    </select>
                                </div>

                                <div>
                                    @error('document_type_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">

                                    <label for="document_number">Número do Documento*</label>
                                    <input
                                        class="form-control text-uppercase @error('document_number') is-invalid @endError"
                                        name="document_number" id="document_number"
                                        wire:model="document_number" x-ref="document_number"
                                        type="text"/>
                                </div>

                                <div>
                                    @error('document_number')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">Nome Completo*</label>
                                    <input type="text"
                                           class="form-control text-uppercase @error('full_name') is-invalid @endError"
                                           name="full_name" id="full_name"
                                           wire:model="full_name"
                                    />
                                </div>

                                <div>
                                    @error('full_name')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="social_name">Nome Social</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="social_name" id="social_name" wire:model="social_name"
                                           placeholder="Designação usada por travestis ou transexuais"
                                    />
                                </div>
                            </div>


                            <div class="col-12 row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="has_disability">Possui deficiência?</label>
                                        <select
                                            class="form-select text-uppercase @error('has_disability') is-invalid @endError"
                                            name="has_disability"
                                            id="has_disability"
                                            wire:model="has_disability"
                                            x-ref="has_disability" @disabled(request()->query('disabled'))>
                                            <option value="">
                                                SELECIONE
                                            </option>
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>

                                    <div>
                                        @error('has_disability')
                                        <small class="text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ $message }}
                                        </small>
                                        @endError
                                    </div>

                                </div>

                                <div class="col-md-8 {{toBoolean($has_disability) ? '' : 'd-none'}}">

                                    <div class="form-group">
                                        <label for="disabilities">Tipo de Deficiência*</label>
                                        <br/>
                                        <ul class="disability-list list-unstyled">
                                            @foreach($disabilityTypes as $disabilityType)
                                                <li>
                                                    <label>
                                                        <input name="disabilities[]" wire:model="disabilities"
                                                               value="{{ $disabilityType->id }}" type="checkbox"/>
                                                        {{ $disabilityType->name }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div>
                                        @error('disabilities')
                                        <small class="text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ $message }}
                                        </small>
                                        @endError
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country_id"> País* </label>
                                    <div wire:ignore>
                                        <select class="select2 form-control text-uppercase"
                                                name="country_id" id="country_id"
                                                wire:model="country_id" x-ref="country_id"
                                        >
                                            <option value=""> SELECIONE</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ convert_case($country->name, MB_CASE_UPPER) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    @error('country_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-4 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}"
                                 id="div-state_id">
                                <div class="form-group">
                                    <label for="state_id">Estado*</label>
                                    <div wire:ignore>
                                        <select class="select2 form-control text-uppercase"
                                                name="state_id" id="state_id"
                                                wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                        >
                                            <option value="">SELECIONE</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ convert_case($state->name, MB_CASE_UPPER) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    @error('country_id')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-4 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}"
                                 id="div-city_id">
                                <div class="form-group">
                                    <label for="city_id">Cidade*</label>
                                    <div wire:ignore>
                                        <select class="select2 form-control text-uppercase"
                                                name="city_id" id="city_id"
                                                wire:model="city_id" x-ref="city_id"
                                        >
                                            <option value="">SELECIONE</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id ?? $city['id'] }}">
                                                    {{ mb_strtoupper($city->name ?? $city['name']) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 {{ !$this->detectIfCountryBrSelected() ? '' : 'd-none' }}">
                                <div class="form-group">
                                    <label for="other_city">Cidade*</label>
                                    <input type="text"
                                           class="form-control text-uppercase @error('other_city') is-invalid @endError"
                                           name="other_city" id="other_city" wire:model="other_city"
                                        {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                                </div>

                                <div>
                                    @error('other_city')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="full_name">Email*</label>
                                    <input type="text"
                                           class="form-control @error('responsible_email') is-invalid @endError"
                                           name="responsible_email" id="responsible_email"
                                           wire:model="responsible_email"
                                    />
                                </div>

                                <div>
                                    @error('responsible_email')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="full_name">Confirmação de Email*</label>
                                    <input type="text"
                                           class="form-control @error('confirm_email') is-invalid @endError"
                                           name="confirm_email" id="confirm_email"
                                           wire:model="confirm_email"
                                    />
                                </div>

                                <div>
                                    @error('confirm_email')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="full_name">Telefone (DD) + Número</label>
                                    <input type="text"
                                           class="form-control text-uppercase @error('mobile') is-invalid @endError"
                                           name="mobile" id="mobile"
                                           wire:model="mobile"
                                    />
                                </div>

                                <div>
                                    @error('mobile')
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                            </div>


                            <div class="col-12 align-self-center d-flex justify-content-end gap-4">

                                <button type="submit" class="btn btn-success text-white ml-1" id="submitButton"
                                        title="Salvar">
                                    <i class="fa fa-save"></i> Solicitar
                                </button>

                                <button type="button" wire:click="cleanModal" class="btn btn-danger text-white ml-1">
                                    <i class="fas fa-ban"></i> Cancelar
                                </button>

                            </div>
                        </div>
                    </form>

                    <!-- Flatpickr JS -->
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
                    <script>
                        document.addEventListener('livewire:load', function () {
                            var blockedDates = @json($blockedDates) || [];

                            var flatpickrInstance = flatpickr("#reservation_date", {
                                locale: "pt",
                                dateFormat: "d/m/Y",
                                minDate: "today",
                                maxDate: new Date().fp_incr(30), // 30 days from now
                                disable: blockedDates,
                                onChange: function (selectedDates, dateStr, instance) {
                                @this.set('reservation_date', dateStr);
                                },
                                onDayCreate: function(dObj, dStr, fp, dayElem) {
                                    const date = dayElem.dateObj.toISOString().split('T')[0];
                                    if (blockedDates.includes(date)) {
                                        dayElem.style.color = "red";
                                        dayElem.style.textDecoration = "line-through";
                                    }
                                }
                            });

                            $('#reservation-modal').on('shown.bs.modal', function () {
                                flatpickrInstance.redraw();
                            });

                            Livewire.on('blockedDatesUpdated', function (newBlockedDates) {
                                flatpickrInstance.set('disable', newBlockedDates);
                                flatpickrInstance.redraw();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
