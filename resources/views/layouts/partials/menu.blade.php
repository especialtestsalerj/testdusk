<div class="container-fluid">
    <div class="row long-name text-center">
        <div class="col-12">
            {{ config('app.long_name') }}
        </div>
    </div>

</div>
<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">

        <a class="py-1 navbar-brand" href="{{ url('/') }}" >
            <img src="/img/logo-admin.png" class="img-fluid logo-alerj " title="Alerj" alt="Alerj">
        </a>

        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#globalNavbar" aria-controls="globalNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="globalNavbar" style="">


            <ul class="navbar-nav mr-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item">
{{--                        <a class="nav-link" href="{{ route('admin.index') }}">Painel de Controle</a>--}}
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Tabelas <span class="caret"></span>
                        </a>

                            @can('users:show')
                                <a class="dropdown-item" href="{{ route('event_types.index') }}">
                                    Tipos de Evento
                                </a>
                            @endCan

                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest


            </ul>
        </div>
    </div>
</nav>
