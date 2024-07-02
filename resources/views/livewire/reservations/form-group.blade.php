<div>
    @include('layouts.msg')

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">


            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-60" src="/img/logo-alerj-grande.png" alt="logo">
            </a>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-4xl xl:p-0 mb-10">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">


                    <form name="formulario" id="formulario"
                          action="{{ route('reservation.store')}}" method="POST">

                        @csrf

                        <div class="flex space-x-4">
                            Agendamento em Grupos
                        </div>
                        <div class="flex space-x-4">
                        <div wire:ignore class="w-1/4  ">
                            <label for="sector_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Setor:
                            </label>
                            <select name="sector_id" id="sector_id"
                                    wire:model="sector_id" x-ref="sector_id" wire:change="loadDates"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""> Selecione um setor</option>
                                @foreach ($this->sectors as $sector)
                                    <option value="{{ $sector->id ?? $sector['id']}}">
                                        {{ convert_case($sector->nickname ?? $sector['nickname'], MB_CASE_UPPER) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-1/4  ">
                            <label for="reservation_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Data da Visita *
                            </label>
                            <input id="reservation_date"  type="button"
                                   value="{{$this->reservation_date}}" wire:model="reservation_date"
                                   x-ref="reservation_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <input type="hidden" name="reservation_date" value="{{$this->reservation_date}}" wire:model="reservation_date" />

                        <div class="w-1/4  ">
                            <label for="reservation_time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Hora da Visita *
                            </label>
                            <select
                                name="capacity_id" id="capacity_id"
                                wire:model="capacity_id" x-ref="capacity_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">SELECIONE</option>
                                @foreach ($this->capacities as $capacitiy)
                                    <option value="{{ $capacitiy->id ?? $capacitiy['id']}}">
                                        {{ $capacitiy->maximum_capacity ?? $capacitiy['maximum_capacity'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


