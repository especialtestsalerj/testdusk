<header>
    <div class="px-4 lg:px-6 py-1.5 bg-blue-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="text-white username text-xs">
                Olá, BRENO TRENGROUSE LAIGNIER DE SOUZA <a href="http://ocorrencias.test/logout"><i class="ms-2 fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>

            <div class="relative inline-block text-left">
               {{-- <div>
                    <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        Options
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>--}}
                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                </div>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <nav class="border-gray-200 px-4 lg:px-6 py-4 bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="https://flowbite.com" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>


      {{--      <div class="flex items-center lg:order-2">
                <a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>
                <a href="#" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Get started</a>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
           --}}

            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col font-bold lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Company</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Marketplace</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Features</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Team</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
</header>

{{--

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
                                @endcan
                            </ul>
                        </li>

                    @endcan
                @endguest
            </ul>
        </div>
    </div>
</nav>
--}}
