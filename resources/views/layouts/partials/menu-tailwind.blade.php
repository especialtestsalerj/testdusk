<header>
    <div class="px-4 lg:px-6 py-1.5 bg-brand-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">

            <div class="text-white username text-xs">
                Olá, {{ Auth::user()->name }} <a href="{{route('logout')}}"><i
                        class="ms-2 fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>

            <div class="relative inline-block text-left">
                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        <i class="fa-solid fa-building text-xs text-white me-1"></i>
                        {{ get_current_building()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                </div>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        @foreach($environment['app']['allowedBuildings'] as $building)
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $building->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <nav class="bg-brand-600 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 px-0">

            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="/img/logo-admin.png" class="h-16" title="{{ config('app.description') }}"
                     alt="{{ config('app.name') }}">
            </a>


            <button data-collapse-toggle="navbar-dropdown" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="{{route('reservation.calendar')}}"
                           class="block py-2 px-3 text-white bg-pink-500 rounded md:bg-transparent md:text-white md:p-0 "
                           aria-current="page">Calendário</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-100 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            Agendamento
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                             class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{route('reservation.index')}}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Agenda</a>
                                </li>
                                <li>
                                    <a href="{{route('reservation.calendar')}}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                       aria-current="page">Calendário</a>
                                </li>
                                <li>
                                    <a href="{{route('reservation.configuration')}}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Configurações</a>
                                </li>
{{--                                <li>--}}
{{--                                    <a href="{{route('reservations.form')}}"--}}
{{--                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Agendamento - Bootstrap</a>--}}
{{--                                </li>--}}
                                <li>
                                    <a href="{{route('agendamento.form-tailwind')}}"
                                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Agendamento Tailwind</a>
                                </li>
                            </ul>


                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

</header>
