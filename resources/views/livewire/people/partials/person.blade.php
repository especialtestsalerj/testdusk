<div class="form-group">
    <div x-init=""
         x-data="{ isEditing: {{ !$modal ? 'true' : 'false' }}}"
         @focus-field.window="if($refs[$event.detail.field]) {$refs[$event.detail.field].focus()}"
         @change-mask.window="
     setTimeout(() => {
         //console.log($event); console.log($refs[$event.detail.ref]);
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
     ">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="document_type_id">Tipo de Documento*</label>
                    <select class="form-control text-uppercase"
                            name="document_type_id" id="document_type_id"
                            wire:model.lazy="document_type_id" x-ref="document_type_id"
                            @if ($modal) disabled @endif
                            @if ($readonly) readonly @endif>
                        <option value="">SELECIONE</option>
                        @foreach ($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}">
                                {{ $documentType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input name="person_id" type="hidden" wire:model.defer="person_id">

            <div class="col-4 {{ $document_type_id == config('app.document_type_rg') ? '' : 'd-none' }}">
                <div class="form-group">
                    <label for="state_document_id">@if (is_null($person_id)) Estado do Documento* @else Estado do Documento @endif</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="state_document_id" id="state_document_id"
                                wire:model="state_document_id" x-ref="state_document_id"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
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
            <div class="col-4">
                <div class="form-group">
                    <input type="hidden" name="document_number" id="document_number" wire:model.defer="document_number">
                    <label for="document_number">Número do Documento*</label>
                    <input class="form-control text-uppercase"
                           name="document_number" id="document_number"
                           wire:model="document_number" x-ref="document_number" wire:blur="searchDocumentNumber"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif type="text" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="full_name">Nome Completo*</label>
                    <input type="text" class="form-control text-uppercase"
                           name="full_name" id="full_name"
                           wire:model="full_name"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="social_name">Nome Social</label>
                    <input type="text" class="form-control text-uppercase"
                           name="social_name" id="social_name" wire:model="social_name" placeholder="Designação usada por travestis ou transexuais"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="country_id">@if (is_null($person_id)) País* @else País @endif</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="country_id" id="country_id"
                                wire:model="country_id" x-ref="country_id"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">@if (!$readonly) SELECIONE @endif</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ convert_case($country->name, MB_CASE_UPPER) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-state_id">
                <div class="form-group">
                    <label for="state_id">@if (is_null($person_id)) Estado* @else Estado @endif</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="state_id" id="state_id"
                                wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">@if (is_null($person_id)) SELECIONE @endif</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">
                                    {{ convert_case($state->name, MB_CASE_UPPER) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-city_id">
                <div class="form-group">
                    <label for="city_id">@if (is_null($person_id)) Cidade* @else Cidade @endif</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="city_id" id="city_id"
                                wire:model="city_id" x-ref="city_id"
                                @if ($modal) disabled @endif
                                @if ($readonly) readonly @endif>
                            <option value="">@if (is_null($person_id)) SELECIONE @endif</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id ?? $city['id'] }}">
                                    {{ mb_strtoupper($city->name ?? $city['name']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 {{ !$this->detectIfCountryBrSelected() ? '' : 'd-none' }}">
                <div class="form-group">
                    <label for="other_city">@if (is_null($person_id)) Cidade* @else Cidade @endif</label>
                    <input type="text" class="form-control text-uppercase"
                           name="other_city" id="other_city" wire:model="other_city"
                           @if ($modal) disabled @endif
                           @if ($readonly) readonly @endif
                           {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                </div>
            </div>

            <div class="col-lg-6 col-xl-6">
                @foreach($this->alerts as $alert)
                    <div class="col-12">
                        <span class="text-danger"><i class="fa fa-ban cog-faint" aria-hidden="true"></i> {{$alert }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
