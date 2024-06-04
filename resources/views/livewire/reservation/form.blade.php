<div>

    <div class="row mt-4">
        <h2> Agendamentos</h2>
    </div>
    <form name="formulario" id="formulario"
           action="{{ route('reservation.store')}}" method="POST">
        @csrf
        <div class="row mt-3">
            <div class="form-group col-3">
                <label for="building_id" style="margin-left: 10px;" class="form-label">Edifício:*</label>
                <div wire:ignore>
                    <select class="select2 form-control text-uppercase"
                            name="building_id" id="building_id"
                            wire:model="building_id" x-ref="building_id" >

                        <option value="">SELECIONE</option>
                        @foreach ($buildings as $building)
                            <option value="{{ $building->id }}">
                                {{ convert_case($building->name, MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="country_id" style="margin-left: 10px;" class="form-label">Setor:</label>
                <div wire:ignore>
                    <select class="select2 form-control text-uppercase"
                            name="sector_id" id="sector_id"
                            wire:model="sector_id" x-ref="sector_id" >

                        <option value="">SELECIONE</option>
                        @foreach ($this->sectors as $sector)
                            <option value="{{ $sector->id }}">
                                {{ convert_case($sector->nickname, MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label for="reservation_date" style="margin-left: 10px;" class="form-label">Data da Visita *</label>
                <input type="date" class="form-control " id="reservation_date" name="reservation_date" value="">

            </div>
            <div class="form-group col-3">
                <label for="reservation_time" style="margin-left: 10px;" class="form-label">Hora da Visita *</label>
                <input type="time" class="form-control " name="reservation_time" id="reservation_time">

            </div>
        </div>

        <div class="row">
            <div class='col-2' >
                <div class="form-group">

{{--                    {{dd($this->documentTypes)}}--}}
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




            <div class="col-4">
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
                           name="email" id="email"
                           wire:model="email"
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


        <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
            <button wire:ignore="" class="btn btn-success text-white ml-1" id="submitButton" title="Salvar" onclick="this.disabled=true; this.form.submit();">
                <i class="fa fa-save"></i> Solicitar
            </button>



            <a href="https://www.alerj.rj.gov.br/" id="cancelButton" title="Cancelar" class="btn btn-danger text-white ml-1">
                <i class="fas fa-ban"></i> Cancelar
            </a>
        </div>
    </form>
</div>


