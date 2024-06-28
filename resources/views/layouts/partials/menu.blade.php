<div class="container-fluid topbar-blue login-navbar">
    <div class="row">

        <div class="d-flex align-items-center">

            @if(auth()->check())
                <div class="text-white username">
                    Olá, {{ Auth::user()->name }} <a href="{{ route('logout') }}"><i
                            class="ms-2 fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>

                @include('partials.session-building-select')
            @endIf
        </div>
    </div>
</div>


<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">

        <div>
            <a class="py-1 navbar-brand" href="{{ route('dashboard') }}">
                <img src="/img/logo-admin.png" class="img-fluid logo-alerj " title="{{ config('app.description') }}"
                     alt="{{ config('app.name') }}">
            </a>
        </div>


        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarGlobal" aria-controls="navbarGlobal" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbarGlobal" style="">
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->routeIs('dashboard')) ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">Painel</a>
                    </li>

                    @can('menu-portaria:show')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->routeIs(['people.*', 'visitors.*', 'person-restrictions.*'])) ? 'active' : '' }}"
                               href="#" id="navbarDropdownPortaria" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Portaria
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPortaria">
                                @can('people:show')
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('people.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('people.index') }}">Pessoas</a></li>
                                @endCan
                                @can(make_ability_name_with_current_building('visitors:show'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('visitors.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('visitors.index') }}">Visitas</a></li>
                                @endCan
                                @can(make_ability_name_with_current_building('visitors:checkout'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('visitors.checkout') }}">Checkout</a></li>
                                @endCan
                                @can(make_ability_name_with_current_building('person-restrictions:show'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('person-restrictions.*')) ? 'active' : '' }}"
                                           href="{{ route('person-restrictions.index') }}">Restrições de Acesso</a></li>
                                @endCan


                            </ul>
                        </li>
                    @endcan

                    @can('menu-seguranca:show')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->routeIs(['routines.*', 'sectors.*', 'event-types.*', 'person-restrictions.*', 'certificate-types.*', 'events.*', 'stuffs.*', 'cautions.*', 'people.*'])) ? 'active' : '' }}"
                               href="#" id="navbarDropdownSeguranca" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Segurança
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownSeguranca">
                                @can(make_ability_name_with_current_building('routines:show'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('routines.*', 'events.*', 'stuffs.*', 'cautions.*')) ? 'active' : '' }}"
                                           href="{{ route('routines.index') }}">Rotinas</a></li>
                                @endCan
                                @can('people:show')
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('people.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('people.index') }}">Pessoas</a></li>
                                @endCan
                                @can(make_ability_name_with_current_building('cards:show'))
                                    <li><a class="dropdown-item {{ (request()->routeIs('cards.*')) ? 'active' : '' }}"
                                           href="{{ route('cards.index') }}">Cartões</a></li>
                                @endcan
                                @can(make_ability_name_with_current_building('sectors:show'))
                                    <li><a class="dropdown-item {{ (request()->routeIs('sectors.*')) ? 'active' : '' }}"
                                           href="{{ route('sectors.index') }}">Setores</a></li>
                                @endCan
                                @can('event-types:show')
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('event-types.*')) ? 'active' : '' }}"
                                           href="{{ route('event-types.index') }}">Tipos de Ocorrência</a></li>
                                @endCan
                                @can('certificate-types:show')
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('certificate-types.*')) ? 'active' : '' }}"
                                           href="{{ route('certificate-types.index') }}">Tipos de Porte</a></li>
                                @endCan
                                @can(make_ability_name_with_current_building('person-restrictions:show'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('person-restrictions.*')) ? 'active' : '' }}"
                                           href="{{ route('person-restrictions.index') }}">Restrições de Acesso</a></li>
                                @endCan
                            </ul>
                        </li>
                    @endCan
                    @can('menu-agendamento:show')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->routeIs(['reservation.*'])) ? 'active' : '' }}"
                               href="#" id="navbarDropdownAgendamento" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Agendamentos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownPortaria">
                                @can(make_ability_name_with_current_building('reservation:show'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('reservation.index') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('reservation.index') }}">Agenda</a></li>
                                <li>
                                        <a class="dropdown-item {{ (request()->routeIs('reservation.calendar') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('reservation.calendar') }}">Calendario</a></li>
                                @can(make_ability_name_with_current_building('reservations:associate-users'))
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('reservation.configuration') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('reservation.configuration') }}">Configurações</a></li>
                                @endcan
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('reservation.form') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('reservation.form') }}">Agendamento Bootstrap</a></li>
                                    <li>
                                        <a class="dropdown-item {{ (request()->routeIs('reservation.form-tailwind') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}"
                                           href="{{ route('reservation.form-tailwind') }}">Agendamento Tailwind</a></li>
                                @endcan
                            </ul>
                        </li>

                    @endcan
                @endguest
            </ul>
        </div>
    </div>
</nav>
