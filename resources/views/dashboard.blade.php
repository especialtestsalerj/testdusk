@extends('layouts.app')

@section('content')

            @canany(['visitors:show', 'people:show'])
                    <div dir="ltr" class="col-12">
                        <div class="card bg-white">
                            <div class="card-header">
                                <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                    <div class="col-6 col-lg-3 text-center text-lg-start">
                                        <h4>
                                           Visitas
                                        </h4>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body px-5 py-5 border-bottom rounded">
                                <div class="row mt-3 mb-3 text-center">
                                    @include('partials.dashboard-button', ['url' => route('visitors.index'), 'permission' => 'visitors:show', 'title' => 'Visitantes', 'ico' => 'fa-people-roof'])

                                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'people:show', 'title' => 'Pessoas', 'ico' => 'fa-users'])

{{--                                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'schedules:show', 'title' => 'Agendamentos', 'ico' => 'fa-calendar-days'])--}}
{{--                                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'traffic:show', 'title' => 'Tráfego', 'ico' => 'fa-building'])--}}
                                </div>
                            </div>
                        </div>
            @endcanany

    </div>

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
    </div>
@endsection
