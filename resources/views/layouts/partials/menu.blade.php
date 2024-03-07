<div class="container-fluid topbar-blue login-navbar">
    <div class="row">

        <div class="d-flex align-items-center">
            <div class="text-white username">
                Olá, {{ Auth::user()->name }} <a href="{{ route('logout') }}"><i class="ms-2 fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>


            @include('partials.session-building-select')


        </div>
    </div>
</div>


<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">

        <div>
            <a class="py-1 navbar-brand" href="{{ route('dashboard') }}" >
                <img src="/img/logo-admin.png" class="img-fluid logo-alerj " title="{{ config('app.description') }}" alt="{{ config('app.name') }}">
            </a>
        </div>


        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGlobal" aria-controls="navbarGlobal" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

       {{-- @include('partials.session-building-select')--}}

        <div class="navbar-collapse collapse" id="navbarGlobal" style="">
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->routeIs('dashboard')) ? 'active' : '' }}" href="{{ route('dashboard') }}">Painel</a>
                    </li>

                    @canany(['people:show', 'visitors:show', 'visitors:checkout'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->routeIs(['people.*', 'visitors.*', 'person-restrictions.*'])) ? 'active' : '' }}" href="#" id="navbarDropdownPortaria" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Portaria
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPortaria">
                            @can('people:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('people.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('people.index') }}">Pessoas</a></li>
                            @endCan
                            @can(make_ability_name_with_current_building('visitors:show'))
                                <li><a class="dropdown-item {{ (request()->routeIs('visitors.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('visitors.index') }}">Visitas</a></li>
                            @endCan
                            @can(make_ability_name_with_current_building('visitors:checkout'))
                            <li><a class="dropdown-item {{ (request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('visitors.checkout') }}">Checkout</a></li>
                            @endCan
                            @can('person-restrictions:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('person-restrictions.*')) ? 'active' : '' }}" href="{{ route('person-restrictions.index') }}">Restrições de Acesso</a></li>
                            @endCan
                        </ul>
                    </li>
                    @endcanany

                    @canany([make_ability_name_with_current_building('routines:show'), make_ability_name_with_current_building('sectors:show'), 'event-types:show', 'certificate-types:show'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->routeIs(['routines.*', 'sectors.*', 'event-types.*', 'person-restrictions.*', 'certificate-types.*', 'events.*', 'stuffs.*', 'cautions.*'])) ? 'active' : '' }}" href="#" id="navbarDropdownSeguranca" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Segurança
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSeguranca">
                            @can(make_ability_name_with_current_building('routines:show'))
                                <li><a class="dropdown-item {{ (request()->routeIs('routines.*', 'events.*', 'stuffs.*', 'cautions.*')) ? 'active' : '' }}" href="{{ route('routines.index') }}">Rotinas</a></li>
                            @endCan
                            @can(make_ability_name_with_current_building('cards:show'))
                                <li><a class="dropdown-item {{ (request()->routeIs('cards.*')) ? 'active' : '' }}" href="{{ route('cards.index') }}">Cartões</a></li>
                            @endcan
                            @can(make_ability_name_with_current_building('sectors:show'))
                                <li><a class="dropdown-item {{ (request()->routeIs('sectors.*')) ? 'active' : '' }}" href="{{ route('sectors.index') }}">Setores</a></li>
                            @endCan
                            @can('event-types:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('event-types.*')) ? 'active' : '' }}" href="{{ route('event-types.index') }}">Tipos de Ocorrência</a></li>
                            @endCan
                            @can('certificate-types:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('certificate-types.*')) ? 'active' : '' }}" href="{{ route('certificate-types.index') }}">Tipos de Porte</a></li>
                            @endCan
                            @can('person-restrictions:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('person-restrictions.*')) ? 'active' : '' }}" href="{{ route('person-restrictions.index') }}">Restrições de Acesso</a></li>
                            @endCan
                        </ul>
                    </li>
                    @endcanany

                    <!--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuario">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>-->

<!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortaria" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Edificio Lucio Costa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPortaria">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Palácio Tiradentes
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        Edificio Lucio Costa
                                    </a>
                                </li>

                        </ul>
                    </li>-->
                @endguest
            </ul>
        </div>
    </div>
</nav>
