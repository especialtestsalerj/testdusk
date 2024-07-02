<div>
    <div wire:ignore.self class="modal fade modal-lg" id="reservation-modal" tabindex="-1" role="dialog"
         aria-labelledby="capacityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i> Novo Agendamento
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
                    <form name="formulario" id="formulario"
                          action="{{ route('reservation.store')}}" method="POST">
                        @csrf
                        <!-- Estilo Customizado para Flatpickr -->
                        <style>
                            .flatpickr-calendar {
                                z-index: 1051; /* Ajuste o valor conforme necessário */
                            }
                        </style>
                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="country_id" style="margin-left: 10px;" class="form-label">Setor:</label>
                                <div wire:ignore>
                                    <select class="select2 form-control text-uppercase"
                                            name="sector_modal_id" id="sector_modal_id"
                                            wire:model="sector_id" x-ref="sector_id" wire:change="loadDates" >

                                        <option value="">SELECIONE</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id ?? $sector['id']}}">
                                                {{ convert_case($sector->alias ?? $sector['alias'], MB_CASE_UPPER) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="reservation_date" style="margin-left: 10px;" class="form-label">Data da Visita *</label>
                                <input type="text" class="form-control " id="reservation_date" name="reservation_date" value="{{$this->reservation_date}}" wire:model="reservation_date" x-ref="reservation_date">
                            </div>
                            <div class="form-group col-4">
                                <label for="reservation_time" style="margin-left: 10px;" class="form-label">Hora da Visita *</label>
                                <select class="form-control text-uppercase"
                                        name="capacity_id" id="capacity_id"
                                        wire:model="capacity_id" x-ref="capacity_id" >

                                    <option value="">SELECIONE</option>
                                    @foreach ($this->capacities as $capacitiy)
                                        <option value="{{ $capacitiy->id ?? $capacitiy['id']}}">
                                            {{ $capacitiy->maximum_capacity ?? $capacitiy['maximum_capacity'] }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="motive" style="margin-left: 10px;" class="form-label">Motivo da Visita*</label>
                                <textarea id="motive" name="motive" class="form-control" wire:model="motive">

                                    </textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class='col-3' >
                                <div class="form-group">
                                    <label for="document_type_id">Tipo de Documento*</label>
                                    <select class="form-control text-uppercase"
                                            name="document_type_id" id="document_type_id"
                                            wire:model.lazy="document_type_id" x-ref="document_type_id">
                                        <option value="">SELECIONE</option>
                                        <option value="1">CPF</option>
                                        <option value="2">Passaporte</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">

                                    <label for="document_number">Número do Documento*</label>
                                    <input class="form-control text-uppercase"
                                           name="document_number" id="document_number"
                                           wire:model="document_number" x-ref="document_number"
                                           type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="full_name">Nome Completo*</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="full_name" id="full_name"
                                           wire:model="full_name"
                                    />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="social_name">Nome Social</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="social_name" id="social_name" wire:model="social_name" placeholder="Designação usada por travestis ou transexuais"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="has_disability">Possui deficiência?</label>
                                        <select class="form-select text-uppercase" name="has_disability" id="has_disability"
                                                wire:model="has_disability"
                                                x-ref="has_disability" @disabled(request()->query('disabled'))>
                                            <option value="">
                                                SELECIONE
                                            </option>
                                            <option  value="true">SIM</option>
                                            <option value="false">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                @if($has_disability == 'true')
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
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="country_id"> País* </label>
                                    <div wire:ignore>
                                        <select class="select2 form-control text-uppercase"
                                                name="country_id" id="country_id"
                                                wire:model="country_id" x-ref="country_id"
                                        >
                                            <option value=""> SELECIONE </option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ convert_case($country->name, MB_CASE_UPPER) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-3 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-state_id">
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
                            </div>
                            <div class="col-lg-3 col-xl-3 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-city_id">
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
                            <div class="col-lg-3 col-xl-3 {{ !$this->detectIfCountryBrSelected() ? '' : 'd-none' }}">
                                <div class="form-group">
                                    <label for="other_city">Cidade*</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="other_city" id="other_city" wire:model="other_city"
                                        {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="full_name">Email*</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="responsible_email" id="responsible_email"
                                           wire:model="responsible_email"
                                    />
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="full_name">Confirmação de Email*</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="confirm_email" id="confirm_email"
                                           wire:model="confirm_email"
                                    />
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="full_name">Telefone (DD) + Número</label>
                                    <input type="text" class="form-control text-uppercase"
                                           name="mobile" id="mobile"
                                           wire:model="mobile"
                                    />
                                </div>
                            </div>


                            {{--            <div class="col-lg-12">--}}
                            {{--                <livewire:contacts.form :contacts="$this->contact" :person_id="$this->person_id" :modal="$this->modal" :readonly="$this->readonly" :is-visitors-form="true" />--}}
                            {{--            </div>--}}

                            <div class="col-lg-6 col-xl-6">
                                {{--                @foreach($this->alerts as $alert)--}}
                                {{--                    <div class="col-12">--}}
                                {{--                        <span class="text-danger"><i class="fa fa-ban cog-faint" aria-hidden="true"></i> {{$alert }}</span>--}}
                                {{--                    </div>--}}
                                {{--                @endforeach--}}
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                                <button wire:ignore="" class="btn btn-success text-white ml-1" id="submitButton" title="Salvar" onclick="this.disabled=true; this.form.submit();">
                                    <i class="fa fa-save"></i> Solicitar
                                </button>



                                <a href="https://www.alerj.rj.gov.br/" id="cancelButton" title="Cancelar" class="btn btn-danger text-white ml-1">
                                    <i class="fas fa-ban"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Flatpickr JS -->
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
                    <script>
                        document.addEventListener('livewire:load', function() {
                            var blockedDates = @json($blockedDates) || [];

                            function initializeFlatpickr() {
                                flatpickr("#reservation_date", {
                                    locale: "pt",
                                    dateFormat: "d/m/Y",
                                    minDate: "today",
                                    disable: blockedDates.length ? blockedDates.map(date => ({
                                        from: date,
                                        to: date
                                    })) : [],
                                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                                        const date = dayElem.dateObj.toISOString().split('T')[0];
                                        if (blockedDates.includes(date)) {
                                            dayElem.style.color = "red";
                                            dayElem.style.textDecoration = "line-through";
                                        }
                                    },
                                    onChange: function(selectedDates, dateStr, instance) {
                                    @this.set('reservation_date', dateStr);
                                    }
                                });
                            }

                            $('#reservation-modal').on('shown.bs.modal', function () {
                                initializeFlatpickr();
                            });

                            Livewire.on('blockedDatesUpdated', function(newBlockedDates) {
                                blockedDates = newBlockedDates || [];
                                initializeFlatpickr();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
