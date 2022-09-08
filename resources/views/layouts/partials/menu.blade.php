<div class="container-fluid">
    <div class="row long-name text-center">
        <div class="col-12">
            {{ config('app.long_name') }}
        </div>
    </div>

</div>
<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">

        <a class="py-1 navbar-brand" href="{{ route('dashboard') }}" >
            <img src="/img/logo-admin.png" class="img-fluid logo-alerj " title="Alerj" alt="Alerj">
        </a>

        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarGlobal" aria-controls="navbarGlobal" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCadastro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownCadastro">
                            @can('sectors:show')
                                <li><a class="dropdown-item" href="{{ route('sectors.index') }}">Setores</a></li>
                            @endCan
                            @can('event_types:show')
                                <li><a class="dropdown-item" href="{{ route('event_types.index') }}">Tipos de Ocorrência</a></li>
                            @endCan
                            @can('routines:show')
                                <li><a class="dropdown-item" href="{{ route('routines.index') }}">Rotinas</a></li>
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
