@extends('layouts.app')

@section('content')

    @canany(['visitors:show', 'people:show'])
        <!---------- NOVO LAYOUT DO PORTARIA - LARAVELIZAR ---------->
        <div class="row mt-0 mb-3 bg-dark2 text-white">
            <div class="col pt-2 ps-5">
                <h4>
                    Portaria
                </h4>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="row g-2 g-lg-3 text-uppercase mt-3 d-flex justify-content-center">
                    <div class="col-4">
                        <a href="https://ocorrencias.test/people">
                            <div class="p-3 py-0 mx-3 mb-0 bg-button-home text-center shadow rounded" type="button">
                                <div class="py-5">
                                    <span class="fa-stack fa-5x dashboard-active-icons">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h5 class="mt-4 fs-3 fw-bold">
                                        Pessoas
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="https://ocorrencias.test/visitors">
                            <div class="p-3 py-0 mx-3 mb-0 bg-button-home text-center shadow rounded" type="button">
                                <div class="py-5">
                                    <span class="fa-stack fa-5x dashboard-active-icons">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-people-roof fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <h5 class="mt-4 fs-3 fw-bold">
                                        Visitas
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="https://ocorrencias.test/people">
                            <div class="p-3 py-0 mx-3 mb-0 bg-button-home text-center shadow rounded" type="button">
                                <div class="py-5">
                                            <span class="fa-stack fa-5x dashboard-active-icons">
                                                <i class="fa fa-circle fa-stack-2x"></i>
                                                <i class="fa fa-stack-1x fa-arrow-up-right-from-square fa-inverse"></i>
                                            </span>
                                    <h5 class="mt-4 fs-3 fw-bold">
                                        Checkout
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!---------- FIM DO NOVO LAYOUT DO PORTARIA - LARAVELIZAR ---------->




        <!---------- VELHO LAYOUT DO PORTARIA - APAGAR DEPOIS DE LARAVELIZAR O NOVO ---------->

        <div class="col-12">

            <div dir="ltr" class="col-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                <h4>
                                    Portaria
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-5 py-5 border-bottom rounded">
                        <div class="row mt-3 mb-3 text-center">
                            @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'people:show', 'title' => 'Pessoas', 'ico' => 'fa-users'])
                            @include('partials.dashboard-button', ['url' => route('visitors.index'), 'permission' => 'visitors:show', 'title' => 'Visitas', 'ico' => 'fa-people-roof'])
                            {{--                                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'schedules:show', 'title' => 'Agendamentos', 'ico' => 'fa-calendar-days'])--}}
                            {{--                                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'traffic:show', 'title' => 'Tráfego', 'ico' => 'fa-building'])--}}
                        </div>
                    </div>
                </div>
                @endcanany
            </div>
        </div>


        <!---------- LAYOUT DO OCORRÊNCIAS  ---------->
        <div class="col-12">
            @can('routines:show')
                <!-- Slider main container -->
                <div dir="rtl" class="swiper mt-5">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @forelse ($routines as $routine)
                            <div class="swiper-slide swiper-home">
                                <div dir="ltr" class="col-12">
                                    <div class="card bg-white">
                                        <div class="card-header">
                                            <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                    <h4>
                                                        @can('cautions:show')
                                                            <a href="{{ route('routines.show', ['id' => $routine->id, 'redirect' => 'dashboard']) }}">
                                                                Rotina {{ $routine->code }}
                                                            </a>
                                                        @endcan
                                                        @cannot('cautions:show')
                                                            Rotina {{ $routine?->code }}
                                                        @endcannot
                                                    </h4>
                                                </div>
                                                <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                    <h4>
                                                        @if ($routine->status)
                                                            <span class="badge rounded-pill bg-success">ABERTA</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                    <h4>
                                                        <i class="fas fa-calendar-day ms-lg-3"></i> {{ $routine?->entranced_at?->format('d/m/Y') ?? '-'}}
                                                    </h4>
                                                </div>
                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                    <h4>
                                                        <i class="fas fa-clock ms-lg-3"></i> {{ $routine?->shift?->name ?? '-' }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-5 py-5 border-bottom rounded">
                                            <div class="row mt-3 mb-3 text-center">
                                                @include('partials.dashboard-button', ['url' => route('events.index', $routine->id), 'permission' => 'events:show', 'title' => 'Ocorrências', 'ico' => 'fa-list-check', 'count' => $routine->events()->count()])
                                                @include('partials.dashboard-button', ['url' => route('stuffs.index', $routine->id), 'permission' => 'stuffs:show', 'title' => 'Materiais', 'ico' => 'fa-dolly-box', 'count' => $routine->stuffs()->count()])
                                                @include('partials.dashboard-button', ['url' => route('cautions.index', $routine->id), 'permission' => 'stuffs:show', 'title' => 'Cautelas de Armas', 'ico' => 'fa-gun', 'count' => $routine->cautions()->count()])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            @endCan
            <!-- Slider main container -->
        </div>
        <!---------- FIM DO LAYOUT DO OCORRÊNCIAS  ---------->

        @endsection
