


@extends('layouts.app')
@section('content')
    <div class="py-4 px-4 conteudo">

        <div class="row mb-4 d-flex align-items-center">

            <div class="col-8 col-md-8 d-flex align-items-center">
                <h3><i class="fa-solid fa-cogs"></i> Associar Usuário ao calendário</h3>
            </div>
        </div>

        <livewire:reservations.associate />





    </div>




@endsection


