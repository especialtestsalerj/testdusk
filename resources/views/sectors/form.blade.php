@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('sectors.update', ['id' => $sector->id]) }}" @else action="{{ route('sectors.store')}}" @endIf method="POST">
            @csrf

            @if (isset($sector))
                <input type="hidden" name="id" value="{{ $sector->id }}">
            @endif

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('sectors.index') }}"><i class="fa fa-location-dot"></i> Setores</a>

                            @if(is_null($sector->id))
                                > Novo
                            @else
                                > {{ $sector->id }} - {{ $sector->name }}
                            @endif
                        </h3>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $sector, 'backUrl' => 'sectors.index', 'permission' => (formMode() == 'show' ? make_ability_name_with_current_building('sectors:update') : make_ability_name_with_current_building('sectors:store'))])
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input class="form-control text-uppercase" id="name" name="name" value="{{is_null(old('name')) ? $sector->name : old('name')}}" @include('partials.disabled', ['model' => $sector, 'permission' => make_ability_name_with_current_building('sectors:store')])/>
                        </div>

                        <div class="form-group">
                            <label for="name">Nome Público*</label>

                            <input class="form-control text-uppercase" id="nickname" name="nickname" value="{{$sector->nickname}}" />
                        </div>

                        <div class="form-group">
                            <label for="name">Unidade*</label>

                            <input class="form-control text-uppercase"
                                   @if(formMode() == 'show')
                                       value="{{$sector->building->name}}"
                                   @else
                                       value="{{$currentBuilding->name}}"
                                   @endIf
                                   disabled
                            />
                            <input type="hidden" class="form-control text-uppercase" id="building_id" name="building_id"
                                   @if(formMode() == 'show')
                                       value="{{is_null(old('building_id')) ? $sector->building_id : old('building_id')}}"
                                   @else
                                       value="{{$currentBuilding->id}}"
                                   @endIf
                            />
                        </div>

                        <div class="form-group">
                            <label for="status">Status*</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" dusk="checkboxSectors" type="checkbox" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $sector->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model' => $sector, 'permission' => make_ability_name_with_current_building('sectors:store')])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="is_visitable" value="false">
                                <input class="form-check-input" dusk="checkboxSectors" type="checkbox" id="is_visitable" name="is_visitable" {{(is_null(old('is_visitable')) ? (formMode() == 'create' ? true : $sector->is_visitable) : old('is_visitable')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model' => $sector, 'permission' => make_ability_name_with_current_building('sectors:store')])>
                                <label class="form-check-label" for="is_visitable">Aceita Agendamento</label>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
