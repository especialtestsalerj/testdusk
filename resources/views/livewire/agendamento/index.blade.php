@extends('layouts.app')

@section('content')
    <section class="bg-center h-screen bg-no-repeat" style="background-image: url('{{ asset('img/fundo_alerj.jpg') }}');">
        <div class="w-full flex flex-col items-center justify-center px-4 mx-auto max-w-screen-xl text-center">
            <img src="{{ asset('img/logo-alerj-grande.png') }}" class="w-2/3 sm:w-1/3 md:w-1/4 lg:w-1/5 mb-4" alt="Logo ALERJ">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-brand-600 md:text-5xl lg:text-6xl">
                Agendamentos de Visitas
            </h1>
            <p class="mb-8 text-lg font-bold text-gray-600 lg:text-xl sm:px-16 lg:px-48">
                Bem-vindo ao Sistema de Agendamento da Assembleia Legislativa do Estado do Rio de Janeiro.
                <br /> Por favor, escolha uma das opções abaixo para continuar.
            </p>
        </div>

        <div class="flex items-center justify-center relative z-10 pt-32">
            <div class="w-10/12 2xl:w-3/4 mx-auto sm:mx-auto my-4 sm:my-0 ">
                <div class="flex flex-col sm:flex-row gap-x-8">

                    <div class="w-full lg:w-1/2">
                        <div class="relative p-5 bg-white rounded-lg shadow mt-4 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:shadow-xl duration-300">
                            <div class="relative z-10">
                                <div class="w-10/12">
                                    <form method="get" action="{{route('agendamento.form')}}">
                                        @csrf
                                        <h3 class="font-medium text-2xl text-gray-800">Agende sua visita.</h3>
                                        <div class="mt-6">
                                            <select name="building_id" id="building_id" class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm opacity-80">
                                                <option value="">Selecione o Edifício.</option>
                                                @foreach($this->buildings as $building)
                                                    <option value="{{$building->id}}">{{$building->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('building_id')
                                            <small class="text-danger text-red-800">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="mt-6 md:mt-8">
                                            <button class="w-full md:w-auto text-sm bg-brand-800 hover:bg-brand-950 px-4 py-2 text-white rounded-3xl font-medium">
                                                Agende sua visita agora
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2">
                        <div class="relative p-5 bg-white rounded-lg shadow mt-4 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:shadow-xl duration-300">
                            <div class="relative z-10">
                                <form method="post" action="{{ route('agendamento.recover')}}">
                                    @csrf
                                    <h3 class="font-medium text-2xl text-gray-800">Consulte seu agendamento.</h3>
                                    <div class="mt-6">
                                        <input type="text" id="documentNumber" wire:model="documentNumber" class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm opacity-80" name="documentNumber" placeholder="Documento">
                                    </div>
                                    @error('documentNumber')
                                    <small class="text-danger text-red-800">{{ $message }}</small>
                                    @enderror
                                    @if(session('message'))
                                        <small class="text-success text-green-600">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ session('message') }}
                                        </small>
                                    @endif
                                    <div class="mt-6 md:mt-8">
                                        <!-- Adiciona o widget do reCAPTCHA v2 (Caixa de Seleção) -->
                                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        @error('g-recaptcha-response')
                                        <small class="text-danger text-red-800">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-6 md:mt-8">
                                        <button class="g-recaptcha w-full md:w-auto text-sm bg-brand-800 hover:bg-brand-950 px-4 py-2 text-white rounded-3xl font-medium">
                                            Consultar Agendamento
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="block absolute z-0 bottom-0 right-0">
                                <img src="{{ asset('/img/conference2.svg') }}" class="h-64">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection
