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

                            {{--                            <div wire:ignore class="w-1/4  ">--}}
                            {{--                                <label for="building_id"--}}
                            {{--                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">--}}
                            {{--                                    Edifício:*--}}
                            {{--                                </label>--}}
                            {{--                                <select name="building_id" id="building_id"--}}
                            {{--                                        wire:model="building_id" x-ref="building_id" wire:change="loadSectors"--}}
                            {{--                                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
                            {{--                                    <option value="">SELECIONE</option>--}}
                            {{--                                    @foreach ($buildings as $building)--}}
                            {{--                                        <option value="{{ $building->id }}">--}}
                            {{--                                            {{ convert_case($building->name, MB_CASE_UPPER) }}--}}
                            {{--                                        </option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}

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

                        <div class="flex space-x-4">
                            <div class="w-full">

                                {{--                                <form class="max-w-sm mx-auto">--}}
                                <label for="motive"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Motivo da Visita*
                                </label>
                                <textarea id="motive" rows="4"
                                          name="motive" wire:model="motive"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Leave a comment"></textarea>
                                {{--                                </form>--}}

                            </div>
                        </div>


                        <div class="flex space-x-4">
                            <div class="w-4/5">
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="email"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Tipo de Documento*
                                        </label>
                                        <select name="document_type_id" id="document_type_id"
                                                x-ref="document_type_id"
                                                wire:model.lazy="document_type_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">SELECIONE</option>
                                            <option value="1">CPF</option>
                                            <option value="2">Passaporte</option>
                                        </select>

                                    </div>

                                    <div class="w-1/2">
                                        <label for="document_number"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Número do Documento*
                                        </label>

                                        <input name="document_number" id="document_number"
                                               wire:model="document_number" x-ref="document_number"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="w-1/5">
                                <label for="has_disability"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Possui deficiência? = {{$has_disability}}
                                </label>
                                <select
                                    name="has_disability" id="has_disability"
                                    wire:model="has_disability"
                                    x-ref="has_disability" @disabled(request()->query('disabled'))
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">
                                        SELECIONE
                                    </option>
                                    <option value="true">SIM</option>
                                    <option value="false">NÃO</option>
                                </select>
                            </div>
                        </div>

                        @if($has_disability == 'true')
                            <div class="flex space-x-4" >
                                <label for="disabilities"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Deficiência*</label>
                                <br/>
                                <ul class="disability-list list-unstyled">
                                    @foreach($disabilityTypes as $disabilityType)
                                        <li>
                                            <label class="w-1/2" >
                                                <input name="disabilities[]" wire:model="disabilities"
                                                       value="{{ $disabilityType->id }}" type="checkbox"/>
                                                {{ $disabilityType->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nome Completo*
                                </label>
                                <input name="full_name" id="full_name"
                                       wire:model="full_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="nome completo">
                            </div>
                            <div class="w-1/2">
                                <label for="social_name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nome Social
                                </label>
                                <input name="social_name" id="social_name" wire:model="social_name"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="nome social">
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <div wire:ignore class="w-1/3">
                                <label for="country_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    País*
                                </label>
                                <select name="country_id" id="country_id"
                                        wire:model="country_id" x-ref="country_id"
                                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value=""> SELECIONE</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ convert_case($country->name, MB_CASE_UPPER) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-1/3 {{ $this->detectIfCountryBrSelected() ? '': 'hidden' }}">
                                <div wire:ignore>
                                    <label for="state_id"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Estado*
                                    </label>
                                    <select id="state_id"
                                            name="state_id"
                                            wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                            class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">SELECIONE</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ convert_case($state->name, MB_CASE_UPPER) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="w-1/3 {{ $this->detectIfCountryBrSelected() ? '' : 'hidden' }}">
                                <div wire:ignore>
                                    <label for="city_id"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Cidade*
                                    </label>
                                    <select name="city_id" id="city_id"
                                            wire:model="city_id" x-ref="city_id"
                                            class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">SELECIONE</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id ?? $city['id'] }}">
                                                {{ mb_strtoupper($city->name ?? $city['name']) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="{{ !$this->detectIfCountryBrSelected() ? '' : 'hidden' }} w-1/3">
                                <div class="form-group">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                           for="other_city">Cidade*</label>
                                    <input type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           name="other_city" id="other_city" wire:model="other_city"
                                        {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                                </div>
                            </div>

                        </div>


                        <div class="flex space-x-4">
                            <div class="w-1/3">
                                <label for="responsible_email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email*
                                </label>
                                <input type="email" name="responsible_email" id="responsible_email"
                                       wire:model="responsible_email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@company.com">
                            </div>

                            <div class="w-1/3">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Confirmação de Email*
                                </label>
                                <input type="email" name="confirm_email" id="confirm_email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@company.com" wire:model="confirm_email">
                            </div>


                            <div class="w-1/3">
                                <label for="mobile"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Telefone (DD) + Número
                                </label>
                                <input name="mobile" id="mobile" wire:model="mobile"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="(xx)xxxxx-xxxx">

                            </div>

                        </div>
                        <div class="flex space-x-4">
                                <div class="space-y-4">
                                    <table>
                                        <tr>
                                            <th colspan="2">
                                                Membros do Grupo
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Nome
                                            </th>
                                            <th>
                                                Tipo de Documento
                                            </th>
                                            <th>
                                                Documento
                                            </th>
                                            <th> Ação</th>
                                        </tr>

                                    @foreach($inputs as $index => $input)
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="Nome" class="border p-2 rounded w-full" wire:model="inputs.{{ $index }}.name" name="inputs.{{ $index }}.name">
                                            </td>
                                            <td>
                                                <select wire:model="inputs.{{ $index }}.documentType" name="inputs.{{ $index }}.documentType">
                                                    <option value="">Tipo de documento</option>
                                                    <option value="1">CPF</option>
                                                    <option value="2">Passaporte</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" placeholder="Documento" class="border p-2 rounded w-full" wire:model="inputs.{{ $index }}.cpf" name="inputs.{{ $index }}.cpf">
                                            </td>
                                            <td>

                                            <input type="button" class="bg-red-500 text-white p-2 rounded" wire:click="removeInput({{ $index }})" value="Remover"/>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </table>
                                </div>
                        </div>
                        <div class="flex space-x-4 space-y-2">

                                <div class="w-/13">
                                    <input type="button" class="mt-4 bg-blue-500 text-white p-2 rounded" wire:click="addInput" value="Adicionar Pessoa">
                                </div>
                        </div>
                        <div class="flex space-x-4 space-y-2">



                            <button wire:ignore=""
                                    class="w-full text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                    id="submitButton" title="Salvar" onclick="this.disabled=true; this.form.submit();">
                                <i class="fa fa-save"></i> Solicitar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            console.log(@json($blockedDates))
            var blockedDates = @json($blockedDates);
            var flatpickrInstance = flatpickr("#reservation_date", {
                locale: "pt",
                dateFormat: "d/m/Y",
                minDate: "today",
                maxDate: new Date().fp_incr(30), // 30 days from now
                disable: blockedDates,
                onChange: function (selectedDates, dateStr, instance) {
                @this.
                set('reservation_date', dateStr);
                }
            });

            Livewire.on('blockedDatesUpdated', function (newBlockedDates) {
                flatpickrInstance.set('disable', newBlockedDates);
            });
        });


    </script>
</div>


