<div>
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" action="{{ route('people.update', ['id' => $person->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $person->id }}">
            <input type="hidden" name="redirect" id="redirect" value="people.index">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            <a href="{{ route('people.index') }}">Pessoas</a>

                            @if(is_null($person->id))
                                > Novo
                            @else
                                > {{ $person->id }} - {{ $person->name }}
                            @endif
                        </h4>
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
                        <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="full_name">Nome Completo*</label>
                            <input type="text" class="form-control text-uppercase" name="full_name" id="full_name" wire:model.defer="full_name" value="{{ is_null(old('full_name')) ? $person->full_name: old('full_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="social_name">Nome Social</label>
                            <input type="text" class="form-control text-uppercase" name="social_name" id="social_name" wire:model.defer="social_name" value="{{ is_null(old('social_name')) ? $person->social_name: old('social_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control text-lowercase" name="email" id="email" wire:model="email" value="{{ is_null(old('email')) ? $person->email: old('email') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="birthdate">Nascimento</label>
                            <input type="date" max="3000-01-01" class="form-control" name="birthdate" id="birthdate" wire:model.defer="birthdate" value="{{ is_null(old('birthdate')) ? $person->birthdate : old('birthdate') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>

                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="country_id">País*</label>
                            <select class="form-control text-uppercase select2" name="country_id" id="country_id" wire:model="country_id" x-ref="country_id" @disabled(request()->query('disabled'))>
                                <option value="">SELECIONE O PAÍS</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @if($country_id == "" || $country_id == $country_br->id)
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="state_id">Estado</label>
                                <select class="form-control text-uppercase select2" name="state_id" id="state_id" wire:model="state_id" x-ref="state_id" wire:change="loadCities" @disabled(request()->query('disabled'))>
                                    <option value="">SELECIONE O ESTADO</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->initial}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="city_id">Cidade</label>
                                <select class="select2 form-control text-uppercase select2" name="city_id" id="city_id" wire:model="city_id" x-ref="city_id" @disabled(request()->query('disabled'))>
                                    <option value="">SELECIONE A CIDADE</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{mb_strtoupper($city->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="other_city">Cidade</label>
                                <input type="text" name="other_city" class="form-control text-uppercase" wire:model="other_city" x-ref="other_city" @disabled(request()->query('disabled'))/>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-2">
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

                        @if($has_disability == 'true')
                            <div class="row">
                                <div class="col-md-12">
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
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4  bg-light border rounded-3">
                        <table class="table">
                            <tr>
                                <th colspan="3" class="text-center">Documentos</th>
                            </tr>
                            <tr>
                                <th>Tipo</th>
                                <th>Número</th>
                                <th>Ação</th>
                            </tr>
                        @foreach($person->documents as $document)
                            <tr>
                                <td>{{$document->documentType->name}} </td>
                                <td>{{$document->numberMaskered}}</td>
                                <td>
                                    <span class="btn btn-link px-0 py-0" >
                                    <i class="fa fa-pencil"></i>
                                    </span>
                                    <span class="btn btn-link px-0 py-0" wire:click="prepareForDeleteDocument({{$document->id}})">
                                    <i class="fa fa-trash"></i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-right align-content-end">
                                    <span class="btn btn-link px-0 py-0" data-bs-toggle="modal" data-bs-target="#document-modal">

                                        <i class="fa fa-plus"></i> Novo
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @livewire('documents.modal',['person_id' =>$person->id])

</div>
