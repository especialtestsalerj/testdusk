<div>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">

            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-60" src="{{asset('/img/logo-alerj-grande.png')}}" alt="logo">
            </a>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-4xl xl:p-0 mb-10">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    @csrf

                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                        <div wire:ignore class="w-full">
                            <label for="sector_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Setor:
                            </label>
                            <select name="sector_id" id="sector_id"
                                    wire:model="sector_id" x-ref="sector_id" wire:change="loadDates"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""> Selecione um setor</option>
                                @foreach ($this->sectors as $sector)
                                    <option value="{{ $sector->id ?? $sector['id']}}"
                                        {{ $sector_id == ($sector->id ?? $sector['id']) ? 'selected' : '' }}>
                                        {{ convert_case($sector->nickname ?? $sector['nickname'], MB_CASE_UPPER) }}
                                    </option>
                                @endforeach
                            </select>
                            <div>
                                @error('sector_id')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>


                        <div class="w-full">
                            <label for="reservation_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Data da Visita *
                            </label>
                            <input id="reservation_date" type="button"
                                   value="{{$this->reservation_date}}" wire:model="reservation_date"
                                   x-ref="reservation_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div>
                                @error('reservation_date')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>
                        <input type="hidden" name="reservation_date" value="{{$this->reservation_date}}"
                               wire:model="reservation_date"/>

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

                                <label for="motive"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Motivo da Visita*
                                </label>
                                <textarea id="motive" rows="4"
                                          name="motive" wire:model="motive"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Leave a comment"></textarea>
                                {{--                                </form>--}}
                                <div>
                                    @error('motive')
                                    <small class="text-danger text-red-700">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>

                        </div>
                    @endif

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nome Completo*
                            </label>
                            <input name="full_name" id="full_name"
                                   wire:model="full_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="nome completo">
                            <div>
                                @error('full_name')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="social_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nome Social
                            </label>
                            <input name="social_name" id="social_name" wire:model="social_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="nome social">
                        </div>


                        <div class="w-full">
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
                                <option value="4">Passaporte</option>
                            </select>
                            <div>
                                @error('document_type_id')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>

                        </div>

                        <div class="w-full">
                            <label for="document_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Número do Documento*
                            </label>

                            <input name="document_number" id="document_number"
                                   wire:model="document_number" x-ref="document_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                            <div>
                                @error('document_number')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>
                    </div>


                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="document_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Data de Nascimento*
                            </label>

                            <input type="date" name="birthdate" id="birthdate"
                                   wire:model="birthdate" x-ref="birthdate"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                            <div>
                                @error('birthdate')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Possui deficiência?
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input
                                    type="checkbox"
                                    class="sr-only peer"
                                    wire:model="has_disability"
                                    id="has_disability"
                                    name="has_disability"
                                >
                                <div
                                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                <span> {{$has_disability ? 'Sim' : 'Não'}}</span>
                             </span>
                            </label>
                            <div>
                                @error('has_disability')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>

                        </div>


                    </div>

                    @if($has_disability == 'true')
                        <div class="w-full">
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

                    @endif


                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                        <div class="w-full">
                            <div wire:ignore>
                                <label for="country_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    País*
                                </label>
                                <select name="country_id" id="country_id"
                                        wire:model="country_id" x-ref="country_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value=""> SELECIONE</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ convert_case($country->name, MB_CASE_UPPER) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('country_id')
                                    <small class="text-danger text-red-700">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                        </div>

                        <div class="w-full {{ $this->detectIfCountryBrSelected() ? '': 'hidden' }}">
                            <div wire:ignore>
                                <label for="state_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Estado*
                                </label>
                                <select id="state_id"
                                        name="state_id"
                                        wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">SELECIONE</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ convert_case($state->name, MB_CASE_UPPER) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('state_id')
                                    <small class="text-danger text-red-700">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                        </div>

                        <div class="w-full {{ $this->detectIfCountryBrSelected() ? '' : 'hidden' }}">
                            <div wire:ignore>
                                <label for="city_id"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Cidade*
                                </label>
                                <select name="city_id" id="city_id"
                                        wire:model="city_id" x-ref="city_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">SELECIONE</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id ?? $city['id'] }}">
                                            {{ mb_strtoupper($city->name ?? $city['name']) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('city_id')
                                    <small class="text-danger text-red-700">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                        </div>

                        <div class="{{ !$this->detectIfCountryBrSelected() ? '' : 'hidden' }} w-full">
                            <div class="form-group">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                       for="other_city">Cidade*</label>
                                <input type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       name="other_city" id="other_city" wire:model="other_city"
                                    {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                            </div>
                            <div>
                                @error('other_city')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="responsible_email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email*
                            </label>
                            <input type="email" name="responsible_email" id="responsible_email"
                                   wire:model="responsible_email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@company.com">
                            <div>
                                @error('responsible_email')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Confirmação de Email*
                            </label>
                            <input type="email" name="confirm_email" id="confirm_email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="name@company.com" wire:model="confirm_email">
                            <div>
                                @error('confirm_email')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>
                        </div>


                        <div class="w-full">
                            <label for="mobile"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Telefone (DD) + Número
                            </label>
                            <input name="mobile" id="mobile" wire:model="mobile"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="(xx)xxxxx-xxxx">
                            <div>
                                @error('mobile')
                                <small class="text-danger text-red-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </small>
                                @endError
                            </div>

                        </div>

                    </div>

                    <div class="w-full mt-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Visita em Grupo?
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                class="sr-only peer"
                                wire:model="has_group"
                                @disabled(request()->query('disabled'))
                            >
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                <span> {{$has_group ? 'Sim' : 'Não'}}</span>
                             </span>
                        </label>
                        <div>
                            @error('has_group')
                            <small class="text-danger text-red-700">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </small>
                            @endError
                        </div>

                    </div>


                    @if($has_group=='true')

                        <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Instituição/Empresa
                                </label>
                                <input name="institution" id="institution"
                                       wire:model="institution"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                <div>
                                    @error('institution')
                                    <small class="text-danger text-red-700">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </small>
                                    @endError
                                </div>
                            </div>
                        </div>

                        {{--                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">--}}
                        {{--                            <div class="w-full">--}}
                        {{--                                <table>--}}
                        {{--                                    <tr>--}}
                        {{--                                        <th colspan="2">--}}
                        {{--                                            Membros do Grupo--}}
                        {{--                                        </th>--}}
                        {{--                                    </tr>--}}
                        {{--                                    <tr>--}}
                        {{--                                        <th>--}}
                        {{--                                            Nome--}}
                        {{--                                        </th>--}}
                        {{--                                        <th>--}}
                        {{--                                            Tipo de Documento--}}
                        {{--                                        </th>--}}
                        {{--                                        <th>--}}
                        {{--                                            Documento--}}
                        {{--                                        </th>--}}
                        {{--                                        <th> Ação</th>--}}
                        {{--                                    </tr>--}}

                        {{--                                    @foreach($inputs as $index => $input)--}}
                        {{--                                        <tr>--}}
                        {{--                                            <td>--}}
                        {{--                                                <input type="text" placeholder="Nome" class="border p-2 rounded w-full"--}}
                        {{--                                                       wire:model="inputs.{{ $index }}.name"--}}
                        {{--                                                       name="inputs[{{ $index }}][name]">--}}
                        {{--                                            </td>--}}
                        {{--                                            <td>--}}
                        {{--                                                <select wire:model="inputs.{{ $index }}.documentType"--}}
                        {{--                                                        name="inputs[{{ $index }}][documentType]">--}}
                        {{--                                                    <option value="">Tipo de documento</option>--}}
                        {{--                                                    <option value="1">CPF</option>--}}
                        {{--                                                    <option value="4">Passaporte</option>--}}
                        {{--                                                </select>--}}
                        {{--                                            </td>--}}
                        {{--                                            <td>--}}
                        {{--                                                <input type="text" placeholder="Documento"--}}
                        {{--                                                       class="border p-2 rounded w-full"--}}
                        {{--                                                       wire:model="inputs.{{ $index }}.document"--}}
                        {{--                                                       name="inputs[{{ $index }}][document]">--}}
                        {{--                                            </td>--}}
                        {{--                                            <td>--}}

                        {{--                                                <input type="button"--}}
                        {{--                                                       class="w-full md:w-auto text-sm bg-red-700 px-4 py-2 text-white rounded-3xl font-medium"--}}
                        {{--                                                       wire:click="removeInput({{ $index }})" value="Remover"/>--}}

                        {{--                                            </td>--}}
                        {{--                                        </tr>--}}

                        {{--                                    @endforeach--}}
                        {{--                                </table>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                            <div class="sm:col-span-3">
                                <h1 scope="col" class="text-center font-bold pb-3">
                                    Membros do Grupo
                                </h1>
                                <table class="w-full border-collapse table-auto">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>

                                        <th scope="col" class="px-6 py-3">
                                            Nome
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tipo de Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inputs as $index => $input)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                <label class="sm:hidden block font-semibold mb-1">Nome</label>
                                                <input type="text" placeholder="Nome"
                                                       class="border border-gray-300 p-2 rounded w-full focus:ring focus:ring-blue-500 focus:border-blue-500"
                                                       wire:model="inputs.{{ $index }}.name"
                                                       name="inputs[{{ $index }}][name]">
                                            </td>
                                            <td class="px-6 py-4">
                                                <label class="sm:hidden block font-semibold mb-1">Tipo de
                                                    Documento</label>
                                                <select wire:model="inputs.{{ $index }}.documentType"
                                                        name="inputs[{{ $index }}][documentType]"
                                                        class="border border-gray-300 p-2 rounded w-full focus:ring focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Tipo de documento</option>
                                                    <option value="1">CPF</option>
                                                    <option value="4">Passaporte</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4">
                                                <label class="sm:hidden block font-semibold mb-1">Documento</label>
                                                <input type="text" placeholder="Documento"
                                                       class="border border-gray-300 p-2 rounded w-full focus:ring focus:ring-blue-500 focus:border-blue-500"
                                                       wire:model="inputs.{{ $index }}.document"
                                                       name="inputs[{{ $index }}][document]">
                                            </td>
                                            <td class="px-6 py-4">
                                                <button type="button"
                                                        class="w-full sm:w-auto text-sm bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg focus:ring focus:ring-red-500 focus:outline-none"
                                                        wire:click="removeInput({{ $index }})">
                                                    Remover
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="flex space-x-4 space-y-2 mt-2">

                            <div class="w-/13">
                                {{--                                    <input type="button" class="mt-4 bg-blue-500 text-white p-2 rounded" wire:click="addInput" value="Adicionar Pessoa">--}}
                                <input type="button" wire:click="addInput" style="background-color: rgb(14, 44, 69);"
                                       class="w-full md:w-auto text-sm bg-brand-800 px-4 py-2 text-white rounded-3xl font-medium"
                                       value="Adicionar Pessoa">


                            </div>
                        </div>
                    @endif
                    <div class="flex space-x-4 space-y-2 mt-2">
                        <div class="w-1/5">
                            <div class="mt-5">
                                <button wire:click="save"
                                        wire:loading.attr="disabled"
                                        wire:target="save"
                                        style="background-color: rgb(14, 44, 69);"
                                        class="w-1/3 w-full md:w-auto text-sm bg-brand-800 px-4 py-2 text-white rounded-3xl font-medium"
                                        id="submitButton" title="Salvar">
                                    <i class="fa fa-save"></i> Solicitar
                                </button>
                            </div>
                        </div>
                        <div class="w-1/5">
                            <div class="mt-5">
                                <a href="{{route('agendamento.index')}}"
                                   class="w-1/3 w-full md:w-auto text-sm bg-red-700 px-4 py-2 text-white rounded-3xl font-medium"
                                >
                                    Cancelar
                                </a>
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


