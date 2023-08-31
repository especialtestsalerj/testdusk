@extends('layouts.app')

@section('content')


    <div class="py-4 px-4">
        <form name="formulario" id="formulario" @if(formMode() == 'show') action="{{ route('people.update', ['id' => $person->id]) }}" @else action="{{ route('people.store')}}" @endIf method="POST">
            @csrf

            @if (isset($person->id))
                <input type="hidden" name="id" value="{{ $person->id }}">
            @endif

            <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">

            <div class="">
                <div class="row">
                    <div class="col-sm-8 align-self-center">
                        <h4 class="mb-0">
                            @if(is_null($person->id))
                                <a href="{{ route('people.index')  }}">Pessoas</a>
                                > Novo/a
                            @else
                                <a href="{{ route(request()->query('redirect')) }}">Pessoas</a>
                                > {{ $person->id }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">

                        @include('partials.save-button',
                                ['model' => $person, 'backUrl' => 'people.create',
                                'showSave'=>!(isset($mode) && $mode == 'show-read-only'), //showSave = true if and only if $mode='show-read-only'
                                'permission' => (formMode() == 'show' ? 'people:update' : 'people:store')])
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
                            <label for="full_name">Nome Completo*</label>
                            <input type="text" class="form-control text-uppercase" name="full_name" id="full_name" value="{{ is_null(old('full_name')) ? $person->full_name: old('full_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="social_name">Nome Social</label>
                            <input type="text" class="form-control text-uppercase" name="social_name" id="social_name" value="{{ is_null(old('social_name')) ? $person->social_name: old('social_name') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="birthdate">Nascimento</label>
                            <input type="date" max="3000-01-01" class="form-control" name="birthdate" id="birthdate" value="{{ is_null(old('birthdate')) ? $person->birthdate : old('birthdate') }}" @disabled(request()->query('disabled'))/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="gender_id">Gênero</label>
                            <select class="select2 form-control" name="gender_id" id="gender_id" @disabled(request()->query('disabled'))>
                                <option value=""></option>
                                @foreach ($genders as $key => $gender)
                                    @if(((!is_null($person->id)) && (!is_null($person->gender_id) && $person->gender_id === $gender->id) || (!is_null(old('gender_id'))) && old('gender_id') == $gender->id))
                                        <option selected="selected">{{ $gender->name }}</option>
                                    @else
                                        <option>{{ $gender->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="has_disability">Possui deficiência?*</label>
                            <select class="form-select form-control" name="has_disability" id="has_disability" @disabled(request()->query('disabled'))>
                                <option {{ is_null($person->has_disability) ? ' selected' : '' }}>SELECIONE</option>
                                <option {{ $person->has_disability ? ' selected' : '' }}>SIM</option>
                                <option {{ !is_null($person->has_disability) && !$person->has_disability ? ' selected' : '' }}>NÃO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                /*$(document).ready(function () {
                    $('#has_disability').on('change', function(){
                        alert($('#has_disability').val());
                        //var id = $(this).attr('data-id');
                    });
                });*/
                /*$('#has_disability').change(function() {
                    alert('ok');
                });*/
                /*
                $('#contact_type_id').on('change', function() {
                const e = document.getElementById('contact_type_id')

                $this.currentContactType = e.options[e.selectedIndex].value
            })
                 */
                $(document).ready(function () {
                    alert('ok');
                });
            </script>
        </form>
    </div>

    @include('partials.button-to-top')
@endsection
