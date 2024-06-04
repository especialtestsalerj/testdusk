


@extends('layouts.app')
@section('content')

{{--                <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    --}}
{{--            <livewire:reservation.appointments-calendar year="2023" month="05"/>--}}
{{--                --}}

    <div class="py-4 px-4 conteudo">

        <div class="row mb-4 d-flex align-items-center">

            <div class="col-8 col-md-8 d-flex align-items-center">
                <h3> <i class="fa-solid fa-calendar-days"></i> Agenda do(s) Setor(es): Informática</h3>
            </div>


            <div class="col-4 col-md-4 align-self-center d-flex justify-content-end gap-4">
                <a id="novo" href="{{route('reservation.form-from-user')}}" class="btn btn-primary text-white float-right" title="Nova Visita">
                    <i class="fa fa-plus"></i> Nova
                </a>
            </div>
        </div>

        @include('reservations.partials.table')
    </div>
@endsection


