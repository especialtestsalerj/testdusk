@extends('layouts.app')

@section('content')

    <nav class="row mt-0 mb-3 bg-dark2 text-white">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @can('menu-portaria:show')
                <button class="nav-link active px-5" id="nav-home-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    <h4>
                        Portaria
                    </h4>
                </button>

            @endcan
            @can('menu-seguranca:show')
                <button class="nav-link @cannot('menu-portaria:show') active @endcannot px-5" id="nav-security-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    <h4>
                        Segurança
                    </h4>
                </button>
            @endcan
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        @can('menu-portaria:show')
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                 tabindex="0">
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-12 col-lg-8">
                        <div class="row g-0 g-lg-3 text-uppercase mt-3 d-flex justify-content-center">
                            @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'people:show', 'title' => 'Pessoas', 'ico' => 'fa-users'])
                            @include('partials.dashboard-button', ['url' => route('visitors.index'), 'permission' => make_ability_name_with_current_building('visitors:show'), 'title' => 'Visitas', 'ico' => 'fa-people-roof', 'count' => $pendingVisitors->count()])
                            @include('partials.dashboard-button', ['url' => route('visitors.checkout'), 'permission' => make_ability_name_with_current_building('visitors:show'), 'title' => 'checkout', 'ico' => 'fa-arrow-up-right-from-square'])
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('menu-seguranca:show')
            @if(!empty($routines))
                <div
                    class="tab-pane fade @cannot([make_ability_name_with_current_building('visitors:show'), 'people:show']) show active @endcannot"
                    id="nav-profile" role="tabpanel" aria-labelledby="nav-security-tab" tabindex="0">

                    <div class="row">
                        <div class="col-12">
                            <div class="container">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-10">
                                        <!-- Slider main container -->
                                        <div dir="rtl" class="swiper mb-5 mt-lg-5">
                                            <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                                <!-- Slides -->
                                                @forelse ($routines as $routine)
                                                    <div class="swiper-slide swiper-home">
                                                        <div dir="ltr" class="col-12">
                                                            <div class="card bg-white">
                                                                <div class="card-header">
                                                                    <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                                        <div
                                                                            class="col-6 col-lg-3 text-center text-lg-start">
                                                                            <h4>
                                                                                @can(make_ability_name_with_current_building('routines:show'))
                                                                                    <a href="{{ route('routines.show', ['id' => $routine->id, 'redirect' => 'dashboard']) }}">
                                                                                        <i class="fa fa-clipboard-list"></i>
                                                                                        Rotina {{ $routine->code }}
                                                                                    </a>
                                                                                @else
                                                                                    Rotina {{ $routine?->code }}
                                                                                @endcan
                                                                            </h4>
                                                                        </div>
                                                                        <div
                                                                            class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                            <h4>
                                                                                @if ($routine->status)
                                                                                    <span
                                                                                        class="badge rounded-pill bg-success">ABERTA</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                                @endif
                                                                            </h4>
                                                                        </div>
                                                                        <div
                                                                            class="col-6 col-lg-3 text-center text-lg-start">
                                                                            <h4>
                                                                                <i class="fas fa-calendar-day ms-lg-3"></i> {{ $routine?->entranced_at?->format('d/m/Y') ?? '-'}}
                                                                            </h4>
                                                                        </div>
                                                                        <div
                                                                            class="col-6 col-lg-3 text-center text-lg-start">
                                                                            <h4>
                                                                                <i class="fas fa-clock ms-lg-3"></i> {{ $routine?->shift?->name ?? '-' }}
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body px-5 py-5 border-bottom rounded">
                                                                    <div
                                                                        class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                                        @include('partials.dashboard-button-swipper', ['url' => route('events.index', $routine->id), 'permission' => make_ability_name_with_current_building('events:show'), 'title' => 'Ocorrências', 'ico' => 'fa-list-check', 'count' => $routine->events()->count()])
                                                                        @include('partials.dashboard-button-swipper', ['url' => route('stuffs.index', $routine->id), 'permission' => make_ability_name_with_current_building('stuffs:show'), 'title' => 'Materiais', 'ico' => 'fa-dolly-box', 'count' => $routine->stuffs()->count()])
                                                                        @include('partials.dashboard-button-swipper', ['url' => route('cautions.index', $routine->id), 'permission' => make_ability_name_with_current_building('stuffs:show'), 'title' => 'Cautelas de Armas', 'ico' => 'fa-person-rifle', 'count' => $routine->cautions()->count()])
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        @endCan
    </div>

@endsection
