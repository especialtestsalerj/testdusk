<div wire:keep-alive>
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" action="{{ route('people.update', ['id' => $person->id]) }}"
              method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $person->id }}">
            <input type="hidden" name="redirect" id="redirect" value="people.index">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('people.index') }}"><i class="fa fa-users"></i> Pessoas</a>

                            @if(is_null($person->id))
                                > Novo
                            @else
                                > {{ $person->id }} - {{ $person->name }}
                            @endif
                        </h3>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $person, 'backUrl' => 'people.index', 'permission' => 'people:update'])
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Nome Completo*</label>
                            <input type="text" class="form-control text-uppercase" name="full_name" id="full_name"
                                   wire:model.defer="full_name"
                                   value="{{ is_null(old('full_name')) ? $person->full_name: old('full_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_name">Nome Social</label>
                            <input type="text" class="form-control text-uppercase" name="social_name" id="social_name"
                                   wire:model.defer="social_name"
                                   value="{{ is_null(old('social_name')) ? $person->social_name: old('social_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control text-lowercase" name="email" id="email"
                                   wire:model.defer="email"
                                   value="{{ is_null(old('email')) ? $person->email: old('email') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthdate">Nascimento</label>
                            <input type="date" max="3000-01-01" class="form-control text-uppercase" name="birthdate"
                                   id="birthdate" wire:model.defer="birthdate"
                                   value="{{ is_null(old('birthdate')) ? $person->birthdate : old('birthdate') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender_id">Gênero</label>
                            <select class="form-select text-uppercase" name="gender_id" id="gender_id"
                                    wire:model="gender_id" x-ref="gender_id" @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" wire:ignore>
                        <div class="form-group">
                            <label for="country_id">País*</label>
                            <select name="country_id" class="select2 form-control text-uppercase" id="country_id"
                                    wire:model="country_id" x-ref="country_id"
                                    @if ($readonly) readonly @endif
                                @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE</option>
                                @foreach ($countries as $country)
                                    <option
                                        value="{{ $country->id }}">{{ convert_case($country->name, MB_CASE_UPPER) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" wire:ignore
                         id="div-state_id">
                        <div class="form-group">
                            <label for="state_id">Estado*</label>
                            <select class="select2 form-control text-uppercase" id="state_id" name="state_id"
                                    wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                    @if ($readonly) readonly @endif
                                @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->initial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" wire:ignore
                         id="div-city_id">
                        <div class="form-group">
                            <label for="city_id">Cidade*</label>
                            <select name="city_id" id="city_id" class="select2 form-control text-uppercase"
                                    wire:model="city_id" x-ref="city_id"
                                    @if ($readonly) readonly @endif
                                @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE</option>
                                @foreach ($cities as $city)
                                    <option
                                        value="{{ $city->id ?? $city['id'] }}">{{ mb_strtoupper($city->name ?? $city['name']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 {{!$this->detectIfCountryBrSelected() ? '' : 'd-none' }}">
                        <div class="form-group">
                            <label for="other_city">Cidade*</label>
                            <input type="text" id="other_city" name="other_city" class="form-control text-uppercase"
                                   value="{{ $other_city }}"
                                   @if ($readonly) readonly @endif
                                {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled' }}
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
                                    <option {{ is_null($person->has_disability) ? ' selected' : '' }} value="">
                                        SELECIONE
                                    </option>
                                    <option {{ $person->has_disability ? ' selected' : '' }} value="true">SIM</option>
                                    <option
                                        {{ !is_null($person->has_disability) && !$person->has_disability ? ' selected' : '' }} value="false">
                                        NÃO
                                    </option>
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
                                                   {{ $person->disabilities->contains($disabilityType->id) ? 'checked' : '' }}

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
                    <div class="col-md-6 mb-2">
                        <div class="row my-2">
                            <div class="col-sm-8 align-self-center">
                                <h3 class="mb-0"><i class="fa fa-id-card"></i>
                                    Documentos
                                </h3>
                            </div>

                            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                                @if(!request()->query('disabled'))
                                    <span class="btn btn-sm btn-primary text-white"
                                          wire:click="createDocument({{ $person->id }})"
                                          data-bs-toggle="modal" data-bs-target="#document-modal"
                                          title="Novo Documento">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @forelse($person->documents as $document)
                            <div class="col-md-12">
                                <div class="cards-striped mx-lg-0 mt-lg-2">
                                    <div class="card">
                                        <div class="card-body py-1">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <span class="fw-bold">Tipo:</span> {{ $document->documentType->name }}
                                                </div>
                                                <div class="col-12 col-lg-6 text-center text-lg-start">
                                                    <span class="fw-bold">Número:</span> {{ $document->numberMaskered }}
                                                </div>
                                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                                    @if(!request()->query('disabled'))
                                                        <span class="btn btn-link"
                                                              wire:click="editDocument({{ $document->id }})"
                                                              data-bs-toggle="modal" data-bs-target="#document-modal"
                                                              title="Alterar Documento">
                                                        <i class="fa fa-lg fa-pencil"></i>
                                                        </span>
                                                        <span class="btn btn-link"
                                                              wire:click="prepareForDeleteDocument({{ $document->id }})"
                                                              title="Remover Documento">
                                                        <i class="fa fa-lg fa-trash"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="alert alert-warning mt-2">
                                        <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhum Documento encontrado.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="row my-2">
                            <div class="col-sm-8 align-self-center">
                                <h3 class="mb-0"><i class="fa fa-person-circle-exclamation"></i>
                                    Restrições de Acesso
                                </h3>
                            </div>
                            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                               <span class="btn btn-sm btn-primary text-white"
                                     wire:click="createRestriction({{ $person->id }})"
                                     data-bs-toggle="modal" data-bs-target="#restriction-modal"
                                     title="Nova Restrição">
                                            <i class="fa fa-plus"></i>
                                        </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @forelse ($person->restrictions as $personRestriction)
                                    <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                                        <div class="card">
                                            <div class="card-body py-1">
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-12 col-lg-6 text-center text-lg-start">
                                                        <span class="fw-bold">Início:</span> {{ $personRestriction?->started_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                                                    </div>
                                                    <div class="col-12 col-lg-6 text-center text-lg-start">
                                                        <span  class="fw-bold">Término:</span> {{ $personRestriction?->ended_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                                                    </div>
                                                    <div class="col-12 col-lg-9 text-center text-lg-start">
                                                        <span class="fw-bold">Mensagem:</span> {{ $personRestriction?->message }}
                                                    </div>
                                                    <div class="col-12 col-lg-3 text-center text-lg-end">
                                                         <span class="btn btn-link"
                                                               wire:click="detailRestriction({{ $personRestriction->id }})"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#restriction-modal"
                                                               title="Detalhar Restrição">
                                                                <i class="fa fa-lg fa-search"></i>
                                                        </span>
                                                        <span class="btn btn-link"
                                                              wire:click="editRestriction({{ $personRestriction->id }})"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#restriction-modal"
                                                              title="Alterar Restrição">
                                                                <i class="fa fa-lg fa-pencil"></i>
                                                        </span>
                                                        <span class="btn btn-link"
                                                              wire:click="prepareForDeleteRestriction({{ $personRestriction->id }})"
                                                              title="Remover Restrição">
                                                             <i class="fa fa-lg fa-trash"></i>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-warning mt-2">
                                        <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Restrição encontrada.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @livewire('documents.modal')
    @livewire('person-restrictions.modal-form')

</div>
