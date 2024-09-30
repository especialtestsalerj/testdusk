<div
    x-data="{
        handleMaskChange(event) {
            setTimeout(() => {
                const ref = this.$refs[event.detail.ref];
                if (ref) {
                    if (event.detail.mask) {
                        VMasker(ref).maskPattern(event.detail.mask);
                    } else {
                        const fieldValue = ref.value;
                        VMasker(ref).unMask();
                        ref.value = fieldValue; // Retorna o valor original após remover a máscara
                    }
                }
            }, 500);
        }
    }"
    x-init=""
    @focus-field.window="if ($refs[$event.detail.field]) { $refs[$event.detail.field].focus(); }"
    @change-mask.window="handleMaskChange($event)"
    @change-contact-mask.window="handleMaskChange($event)"
>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">

            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-60" src="{{asset('/img/logo-alerj-grande.png')}}" alt="logo">
            </a>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-4xl xl:p-0 mb-10">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    @csrf

                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">

                        <x-select
                            name="sector_id"
                            id="sector_id"
                            label="Setor:"
                            :options="$sectors"
                            :options="$sectors->map(function($sector) {
                                            return ['value' => $sector->id, 'text' => mb_strtoupper($sector->nickname)];
                                        })"
                            placeholder="Selecione um setor"
                            :selected="$sector_id"
                            wireModel="sector_id"
                            wireChange="loadDates"
                            xRef="sector_id"
                            required="true"
                        />

                        <x-datepicker
                            id="reservation_date"
                            name="reservation_date"
                            label="Data da Visita"
                            :value="$reservation_date"
                            required="true"
                            wireModel="reservation_date"
                            xRef="reservation_date"
                            :blockedDates="$blockedDates"
                            :maxDate="$maxDate"
                            dateFormat="d/m/Y"
                        />


                        <div class="w-full">
                            <label for="reservation_time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Hora da Visita *
                            </label>


                            @if((!empty($this->reservation_date)) && (!empty($this->sector_id)) && (count($this->capacities) == 0))

                                <input type="text"
                                       class="bg-red-500 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       value="ESGOTADO" disabled="disabled">

                            @else
                                <select
                                    name="capacity_id" id="capacity_id"
                                    wire:model="capacity_id" x-ref="capacity_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">SELECIONE</option>
                                    @foreach ($this->capacities as $capacitiy)
                                        <option value="{{ $capacitiy->id ?? $capacitiy['id']}}">
                                            {{ $capacitiy->hour ?? $capacitiy['hour'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            <div>
                                @error('capacity_id')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>

                    </div>

                    @if($this->sector?->required_motivation)
                        <div class="flex space-x-4 mt-2">
                            <div class="w-full">
                                <x-textarea
                                    id="motive"
                                    name="motive"
                                    label="Motivo da Visita"
                                    rows="4"
                                    wireModel="motive"
                                    xRef="motive"
                                    placeholder="Descreva o motivo da sua visita..."
                                    required="true"
                                    class="mb-4"
                                />
                            </div>
                        </div>

                    @endif

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <x-input
                                id="full_name"
                                name="full_name"
                                label="Nome Completo"
                                type="text"
                                wireModel="full_name"
                                placeholder="Nome completo"
                                required="true"
                            />
                        </div>

                        <div class="w-full">
                            <x-input
                                id="social_name"
                                name="social_name"
                                label="Nome Social"
                                type="text"
                                wireModel="social_name"
                                placeholder="Nome social"
                            />
                        </div>

                        @php
                            $documentTypes = [
                                ['value' => '1', 'text' => 'CPF'],
                                ['value' => '4', 'text' => 'Passaporte'],
                            ];
                        @endphp

                        <div class="w-full">
                            <x-select
                                id="document_type_id"
                                name="document_type_id"
                                label="Tipo de Documento"
                                :options="$documentTypes"
                                placeholder="SELECIONE"
                                :selected="$document_type_id"
                                wireModel="document_type_id"
                                xRef="document_type_id"
                                required="true"
                                class="mb-4"
                            />
                        </div>


                        <div class="w-full">
                            <x-input
                                id="document_number"
                                name="document_number"
                                label="Número do Documento"
                                type="text"
                                wireModel="document_number"
                                placeholder="Número do documento"
                                required="true"
                                xRef="document_number"
                                class="mb-4"
                            />
                        </div>


                    </div>


                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <x-input
                                id="birthdate"
                                name="birthdate"
                                label="Data de Nascimento"
                                type="date"
                                wireModel="birthdate"
                                placeholder=""
                                required="true"
                            />
                        </div>


                        <div class="w-full">
                            <x-switch
                                id="has_disability"
                                name="has_disability"
                                label="Possui deficiência?"
                                wireModel="has_disability"
                                checked="{{ $has_disability }}"
                                required="false"
                            />
                        </div>


                    </div>


                    <div class="{{ $has_disability == 'true' ? '': 'hidden' }}">
                        <div class="w-full ">
                            <label for="disabilities"
                                   class="sm:col-span-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Tipo de Deficiência*
                            </label>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($disabilityTypes as $disabilityType)
                                <label class="max-w-full">
                                    <input name="disabilities[]" wire:model="disabilities"
                                           value="{{ $disabilityType->id }}" type="checkbox"/>
                                    <span>{{ $disabilityType->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>


                    <div class="grid gap-4 md:grid-cols-3 sm:gap-6">
                        <div class="w-full" id="div-country_id" wire:ignore>
                            <x-select2
                                id="country_id"
                                name="country_id"
                                label="País"
                                :options="$countries->map(function($country) {
                                        return ['value' => $country->id, 'text' => mb_strtoupper($country->name)];
                                    })"
                                placeholder="SELECIONE"
                                :selected="$country_id"
                                wire:model="country_id"
                                x-ref="country_id"
                                :required="true"
                                class="mt-1"
                            />
                            @error('country_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        </div>

                        <div class="w-full" id="div-state_id">

                            <div class="w-full" wire:ignore>
                                <x-select2
                                    id="state_id"
                                    name="state_id"
                                    label="Estado"
                                    :options="$states->map(function($state) {
                                            return ['value' => $state->id, 'text' => mb_strtoupper($state->name)];
                                        })"
                                    placeholder="SELECIONE"
                                    :selected="$state_id"
                                    wireModel="state_id"
                                    wireChange="loadCities"
                                    xRef="state_id"
                                    required="true"
                                />
                            </div>
                        </div>

                        <div class="w-full" id="div-city_id" wire:ignore>
                            <x-select2
                                id="city_id"
                                name="city_id"
                                label="Cidade"
                                :options="$cities->map(function($city) {
                                        return [
                                            'value' => is_object($city) ? $city->id : $city['id'],
                                            'text' => mb_strtoupper(is_object($city) ? $city->name : $city['name']),
                                        ];
                                    })"
                                placeholder="SELECIONE"
                                :selected="$city_id"
                                wireModel="city_id"
                                xRef="city_id"
                                required="true"
                            />
                        </div>

                        <div class="{{ !$this->detectIfCountryBrSelected() ? '' : 'hidden' }} w-full">
                            <x-input
                                id="other_city"
                                name="other_city"
                                label="Cidade"
                                type="text"
                                wireModel="other_city"
                                placeholder="Digite a cidade"
                                required="true"
                                :disabled="$this->detectIfCountryBrSelected()"
                                class="mb-4"
                            />
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                        <div class="w-full">
                            <x-input
                                id="responsible_email"
                                name="responsible_email"
                                label="Email"
                                type="email"
                                wireModel="responsible_email"
                                placeholder="name@company.com"
                                required="true"
                                class="mb-4"
                            />
                        </div>

                        <div class="w-full">
                            <x-input
                                id="confirm_email"
                                name="confirm_email"
                                label="Confirmação de Email"
                                type="email"
                                wireModel="confirm_email"
                                placeholder="name@company.com"
                                required="true"
                                class="mb-4"
                            />
                        </div>


                        <div class="w-full">
                            <x-input
                                id="contact"
                                name="contact"
                                label="Telefone (DD) + Número"
                                type="text"
                                wireModel="contact"
                                xRef="contact"
                                placeholder="(xx) xxxxx-xxxx"
                                required="true"
                                class="mb-4"
                            />
                        </div>


                    </div>

                    <div class="w-full mt-2">
                        <x-switch
                            id="has_group"
                            name="has_group"
                            label="Visita em Grupo?"
                            wireModel="has_group"
                            :checked="$has_group"
                            :disabled="request()->query('disabled')"
                        />
                    </div>


                    @if($has_group=='true')

                        <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                            <div class="w-full">
                                <x-input
                                    id="institution"
                                    name="institution"
                                    label="Instituição/Empresa"
                                    type="text"
                                    wireModel="institution"
                                    placeholder="Digite a instituição ou empresa"
                                    required="true"
                                    class="mb-4"
                                />
                            </div>
                        </div>


                        <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                            <div class="sm:col-span-1">
                                <h1 class="text-center font-bold pb-3 text-xl">
                                    Membros do Grupo
                                </h1>

                                <!-- Container dos Cards -->
                                <div class="space-y-4">
                                    @foreach($inputs as $index => $input)
                                        <div
                                            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col space-y-4"
                                            wire:key="input-{{ $index }}">
                                            <!-- Campo de Nome -->
                                            <div>
                                                <x-input
                                                    id="inputs_{{ $index }}_name"
                                                    name="inputs[{{ $index }}][name]"
                                                    label="Nome"
                                                    type="text"
                                                    wireModel="inputs.{{ $index }}.name"
                                                    placeholder="Nome"
                                                    required="true"
                                                    class="border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                />
                                            </div>

                                            <!-- Campo de Tipo de Documento -->
                                            <div>
                                                <x-select
                                                    id="inputs_{{ $index }}_documentType"
                                                    name="inputs[{{ $index }}][documentType]"
                                                    label="Tipo de Documento"
                                                    :options="[
                                                        ['value' => '1', 'text' => 'CPF'],
                                                        ['value' => '4', 'text' => 'Passaporte'],
                                                    ]"
                                                    placeholder="Tipo de documento"
                                                    :selected="$input['documentType'] ?? null"
                                                    wireModel="inputs.{{ $index }}.documentType"
                                                    required="true"
                                                    class="border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                />
                                            </div>

                                            <!-- Campo de Documento -->
                                            <div>
                                                <x-input
                                                    id="inputs_{{ $index }}_document"
                                                    name="inputs[{{ $index }}][document]"
                                                    label="Documento"
                                                    type="text"
                                                    wireModel="inputs.{{ $index }}.document"
                                                    placeholder="Documento"
                                                    required="true"
                                                    class="border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                />
                                            </div>

                                            <!-- Botão de Remover -->
                                            <div class="flex justify-end">
                                                <button type="button"
                                                        class="flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition duration-300"
                                                        wire:click="removeInput({{ $index }})">
                                                    <!-- Ícone de Remover -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Remover
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Botão para Adicionar Nova Linha -->
                                <div class="flex justify-center mt-6">
                                    <button type="button"
                                            style="background-color: rgb(14, 44, 69);"
                                            wire:click="addInput"
                                            class="flex items-center px-6 py-3 bg-brand-800 hover:bg-brand-900 text-white text-sm font-medium rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-brand-500 transition duration-300">
                                        <!-- Ícone de Adicionar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        Adicionar Pessoa
                                    </button>
                                </div>

                            </div>
                        </div>

                    @endif
                    <div
                        class="flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-2 sm:space-y-0 mt-6 text-center">
                        <div class="w-full sm:w-1/2">
                            <div class="flex justify-center mt-6">
                                <div class="w-full sm:w-1/3">
                                    <button wire:click="save"
                                            wire:loading.attr="disabled"
                                            wire:target="save"
                                            style="background-color: rgb(14, 44, 69);"
                                            class="w-1/3 w-full md:w-auto text-sm bg-brand-800 px-6 py-3 text-white rounded-3xl font-medium"
                                            id="submitButton" title="Salvar">
                                        <i class="fa fa-save mr-2"></i> Solicitar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <div class="flex justify-center mt-6">
                                <div class="w-full sm:w-1/3">
                                    <button
                                        onclick="window.location='{{ route('agendamento.index') }}'"
                                        class="bg-red-700 px-6 py-3 text-white w-1/3 w-full md:w-auto text-sm px-4 py-2 text-white rounded-3xl font-medium"
                                        title="Cancelar">
                                        <i class="fa fa-times mr-2"></i>
                                        Cancelar
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {


            var blockedDates = @json($blockedDates);


            var flatpickrInstance = flatpickr("#reservation_date", {
                locale: "pt",
                dateFormat: "d/m/Y",
                minDate: "today",
                maxDate: new Date().fp_incr({{$maxDate}}), // 30 days from now
                disable: [
                    function (date) {
                        // Desativa sábados (6) e domingos (0)
                        return (date.getDay() === 6 || date.getDay() === 0);
                    }
                ].concat(blockedDates),
                onChange: function (selectedDates, dateStr, instance) {
                    @this.
                    set('reservation_date', dateStr);
                }
            });

            Livewire.on('blockedDatesUpdated', function (newBlockedDates) {
                flatpickrInstance.set('disable', [
                    function (date) {
                        // Desativa sábados (6) e domingos (0)
                        return (date.getDay() === 6 || date.getDay() === 0);
                    }
                ].concat(newBlockedDates));

                flatpickrInstance.set('maxDate', new Date().fp_incr({{$maxDate}}));
            });

            Livewire.on('maxDateUpdated', function (newMaxDate) {
                flatpickrInstance.set('maxDate', new Date().fp_incr(newMaxDate));

            });
        });


    </script>

</div>


