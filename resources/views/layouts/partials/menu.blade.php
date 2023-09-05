<div class="container-fluid">
    <div class="row long-name text-center">
        <div class="col-12">
            {{ config('app.long_name') }}
        </div>
    </div>

</div>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">

        <a class="py-1 navbar-brand" href="{{ route('dashboard') }}" >
            <img src="/img/logo-admin.png" class="img-fluid logo-alerj " title="Alerj" alt="Alerj">
        </a>

        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGlobal" aria-controls="navbarGlobal" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link {{ (request()->routeIs('dashboard')) ? 'active' : '' }}" href="{{ route('dashboard') }}">Painel</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->routeIs(['people.*', 'visitors.*'])) ? 'active' : '' }}" href="#" id="navbarDropdownPortaria" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Portaria
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPortaria">
                            @can('people:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('people.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('people.index') }}">Pessoas</a></li>
                            @endCan
                            @can('visitors:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('visitors.*') && !request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('visitors.index') }}">Visitas</a></li>
                            @endCan

                            <li><a class="dropdown-item {{ (request()->routeIs('visitors.checkout')) ? 'active' : '' }}" href="{{ route('visitors.checkout') }}">Checkout</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->routeIs(['routines.*', 'sectors.*', 'event-types.*', 'person-restrictions.*', 'certificate-types.*', 'events.*', 'stuffs.*', 'cautions.*'])) ? 'active' : '' }}" href="#" id="navbarDropdownSeguranca" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Segurança
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSeguranca">
                            @can('routines:show')
                                <li><a class="dropdown-item {{ (request()->routeIs('routines.*', 'events.*', 'stuffs.*', 'cautions.*')) ? 'active' : '' }}" href="{{ route('routines.index') }}">Rotinas</a></li>
                            @endCan
                            @can('sectors:show')
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

                    <li class="nav-item dropdown">
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
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
