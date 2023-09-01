<div>
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" action="{{ route('people.update', ['id' => $person->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $person->id }}">
            <input type="hidden" name="redirect" id="redirect" value="people.index">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('people.index') }}">Pessoas</a>

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
                            <input type="text" class="form-control text-uppercase" name="full_name" id="full_name" wire:model.defer="full_name" value="{{ is_null(old('full_name')) ? $person->full_name: old('full_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="social_name">Nome Social</label>
                            <input type="text" class="form-control text-uppercase" name="social_name" id="social_name" wire:model.defer="social_name" value="{{ is_null(old('social_name')) ? $person->social_name: old('social_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control text-lowercase" name="email" id="email" wire:model="email" value="{{ is_null(old('email')) ? $person->email: old('email') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthdate">Nascimento</label>
                            <input type="date" max="3000-01-01" class="form-control" name="birthdate" id="birthdate" wire:model.defer="birthdate" value="{{ is_null(old('birthdate')) ? $person->birthdate : old('birthdate') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender_id">Gênero</label>
                            <select class="form-control text-uppercase" name="gender_id" id="gender_id" wire:model="gender_id" x-ref="gender_id" @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->name}}</option>
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
                                @if ($readonly) readonly @endif>
                            <option value="">SELECIONE</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($this->detectIfCountryBrSelected())
                    <div class="col-md-4" wire:ignore id="div-state_id">
                        <div class="form-group">
                            <label for="state_id">Estado*</label>
                            <select class="select2 form-control text-uppercase" id="state_id" name="state_id"
                                    wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                    @if ($readonly) readonly @endif>
                                <option value="">SELECIONE</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->initial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" wire:ignore id="div-city_id">
                        <div class="form-group">
                            <label for="city_id">Cidade*</label>
                            <select name="city_id" id="city_id" class="select2 form-control text-uppercase"
                                    wire:model="city_id" x-ref="city_id"
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="other_city">Cidade*</label>
                            <input type="text" name="other_city" class="form-control text-uppercase"
                                   value="{{ $other_city }}"
                                   @if ($readonly) readonly @endif />
                        </div>
                    </div>
                @endIf
            </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="has_disability">Possui deficiência?*</label>
                                <select class="form-control text-uppercase" name="has_disability" id="has_disability"
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
                    <div class="col-md-2">
                        @if($has_disability == 'true')


                            <div class="form-group">
                                <label for="disabilities">Tipos de Deficiências*</label>
                                <br/>
                                @foreach($disabilityTypes as $disabilityType)
                                    <label>
                                        <input name="disabilities[]" wire:model="disabilities"
                                               {{$person->disabilities->contains($disabilityType->id) ? 'checked' : ''}}

                                               value="{{$disabilityType->id}}" type="checkbox"/>
                                        {{$disabilityType->name}}

                                    </label><br/>
                                @endforeach
                            </div>


                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class=" rounded-3">
                            <table class="table bg-light border">
                                <tr>
                                    <th colspan="2" class="text-center">Documentos</th>
                                    <th class="text-end">
                                        @if(!request()->query('disabled'))
                                        <span class="btn btn-primary " wire:click="createDocument({{$person->id}})"
                                              data-bs-toggle="modal" data-bs-target="#document-modal">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                        @endif
                                    </th>

                                </tr>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Número</th>
                                    <th class="text-end">Ação</th>
                                </tr>
                            @foreach($person->documents as $document)
                                <tr>
                                    <td>{{$document->documentType->name}} </td>
                                    <td>{{$document->numberMaskered}}</td>
                                    <td class="text-end">
                                        @if(!request()->query('disabled'))
                                            <span class="btn btn-link px-0 py-0" wire:click="editDocument({{$document->id}})" data-bs-toggle="modal" data-bs-target="#document-modal">
                                            <i class="fa fa-pencil"></i>
                                            </span>
                                            <span class="btn btn-link px-0 py-0" wire:click="prepareForDeleteDocument({{$document->id}})">
                                            <i class="fa fa-trash"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
    {{--                            <tr>--}}
    {{--                                <td colspan="2"></td>--}}
    {{--                                <td class="text-right align-content-end">--}}
    {{--                                    <span class="btn btn-link px-0 py-0" wire:click="createDocument({{$person->id}})" data-bs-toggle="modal" data-bs-target="#document-modal">--}}

    {{--                                        <i class="fa fa-plus"></i> Novo--}}
    {{--                                    </span>--}}
    {{--                                </td>--}}
    {{--                            </tr>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

  @livewire('documents.modal')

</div>
