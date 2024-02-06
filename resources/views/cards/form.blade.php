@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('cards.update', ['id' => $card->id]) }}" @else action="{{ route('cards.store')}}" @endIf method="POST">
            @csrf

            @if (isset($card))
                <input type="hidden" name="id" value="{{ $card->id }}">
            @endif

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h3 class="mb-0">
                            <a href="{{ route('cards.index') }}"><i class="fa fa-id-card"></i> Cartões</a>

                            @if(is_null($card->id))
                                > Novo
                            @else
                                > {{ $card->id }} - {{ $card->number }}
                            @endif
                        </h3>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                        @include('partials.save-button', ['model' => $card, 'backUrl' => 'cards.index', 'permission' => (formMode() == 'show' ? make_ability_name_with_current_building('cards:update') : make_ability_name_with_current_building('cards:store'))])
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
                            <label for="name">Número*</label>
                            <input class="form-control text-uppercase" id="number" name="number" value="{{is_null(old('number')) ? $card->number : old('number')}}" @if(formMode() == 'show') disabled @endif/>
                        </div>

                        <div class="form-group">
                            <label for="name">Unidade*</label>

                            <input class="form-control text-uppercase"
                                   @if(formMode() == 'show')
                                       value="{{$card->building->name}}"
                                   @else
                                       value="{{$currentBuilding->name}}"
                                   @endIf
                                   disabled
                            />
                            <input type="hidden" class="form-control text-uppercase" id="building_id" name="building_id"
                                   @if(formMode() == 'show')
                                       value="{{is_null(old('building_id')) ? $card->building_id : old('building_id')}}"
                                   @else
                                       value="{{$currentBuilding->id}}"
                                   @endIf
                            />
                        </div>

                        <div class="form-group">
                            <label for="status">Status*</label>
                            <div class="form-check">
                                <input class="form-control" type="hidden" name="status" value="false">
                                <input class="form-check-input" dusk="checkboxCards" type="checkbox" id="status" name="status" {{(is_null(old('status')) ? (formMode() == 'create' ? true : $card->status) : old('status')) ? 'checked="checked"' : ''}} @include('partials.disabled', ['model' => $card, 'permission' => make_ability_name_with_current_building('cards:store')])>
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
