<div>
    @include('layouts.msg')

    <!-- Modal toggle -->
    <div class="flex justify-center m-5">
        <button id="updateProductButton" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
            Update product
        </button>
    </div>

    <!-- Main modal -->
    <div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Update Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="#">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" value="iPad Air Gen 5th Wi-Fi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Apple iMac 27&ldquo;">
                        </div>
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                            <input type="text" name="brand" id="brand" value="Google" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Apple">
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" value="399" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$299">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Electronics</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Update product
                        </button>
                        <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Us</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                    <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                    <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                    <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
                </div>
                <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>
            </form>
        </div>
    </section>



    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                Flowbite
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="row mt-4">
        <h2>Agendamentos1111</h2>
    </div>

    <form name="formulario" id="formulario"
           action="{{ route('reservation.store')}}" method="POST">
        @csrf
        <div class="row mt-3">
            <div class="form-group col-3">
                <label for="building_id" style="margin-left: 10px;" class="form-label">Edifício:*</label>
                <div wire:ignore>
                    <select class="select2 form-control text-uppercase"
                            name="building_id" id="building_id"
                            wire:model="building_id" x-ref="building_id" wire:change="loadSectors" >

                        <option value="">SELECIONE</option>
                        @foreach ($buildings as $building)
                            <option value="{{ $building->id }}">
                                {{ convert_case($building->name, MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="country_id" style="margin-left: 10px;" class="form-label">Setor:</label>
                <div wire:ignore>
                    <select class="select2 form-control text-uppercase"
                            name="sector_id" id="sector_id"
                            wire:model="sector_id" x-ref="sector_id" wire:change="loadDates" >

                        <option value="">SELECIONE</option>
                        @foreach ($this->sectors as $sector)
                            <option value="{{ $sector->id ?? $sector['id']}}">
                                {{ convert_case($sector->nickname ?? $sector['nickname'], MB_CASE_UPPER) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-3">
                <label for="reservation_date" style="margin-left: 10px;" class="form-label">Data da Visita *</label>
                <input type="text" class="form-control " id="reservation_date" name="reservation_date" value="{{$this->reservation_date}}" wire:model="reservation_date" x-ref="reservation_date">
            </div>
            <div class="form-group col-3">
                <label for="reservation_time" style="margin-left: 10px;" class="form-label">Hora da Visita *</label>
                <select class="select2 form-control text-uppercase"
                        name="capacity_id" id="capacity_id"
                        wire:model="capacity_id" x-ref="capacity_id" >

                    <option value="">SELECIONE</option>
                    @foreach ($this->capacities as $capacitiy)
                        <option value="{{ $capacitiy->id ?? $capacitiy['id']}}">
                            {{ $capacitiy->maximum_capacity ?? $capacitiy['maximum_capacity'] }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="reservation_date" style="margin-left: 10px;" class="form-label">Motivo da Visita*</label>
                <textarea id="motive" name="motive" class="form-control" wire:model="motive">

                </textarea>
            </div>

        </div>

        <div class="row">
            <div class='col-2' >
                <div class="form-group">


                    <label for="document_type_id">Tipo de Documento*</label>
                    <select class="form-control text-uppercase"
                            name="document_type_id" id="document_type_id"
                            wire:model.lazy="document_type_id" x-ref="document_type_id">
                        <option value="">SELECIONE</option>
                        <option value="1">CPF</option>
                        <option value="2">Passaporte</option>

                    </select>
                </div>
            </div>




            <div class="col-4">
                <div class="form-group">

                    <label for="document_number">Número do Documento*</label>
                    <input class="form-control text-uppercase"
                           name="document_number" id="document_number"
                           wire:model="document_number" x-ref="document_number"
                            type="text" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="full_name">Nome Completo*</label>
                    <input type="text" class="form-control text-uppercase"
                           name="full_name" id="full_name"
                           wire:model="full_name"
                            />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="social_name">Nome Social</label>
                    <input type="text" class="form-control text-uppercase"
                           name="social_name" id="social_name" wire:model="social_name" placeholder="Designação usada por travestis ou transexuais"
                       />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="has_disability">Possui deficiência?</label>
                        <select class="form-select text-uppercase" name="has_disability" id="has_disability"
                                wire:model="has_disability"
                                x-ref="has_disability" @disabled(request()->query('disabled'))>
                            <option value="">
                                SELECIONE
                            </option>
                            <option  value="true">SIM</option>
                            <option value="false">NÃO</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if($has_disability == 'true')
                    <div class="form-group">
                        <label for="disabilities">Tipo de Deficiência*</label>
                        <br/>
                        <ul class="disability-list list-unstyled">
                            @foreach($disabilityTypes as $disabilityType)
                                <li>
                                    <label>
                                        <input name="disabilities[]" wire:model="disabilities"
                                               value="{{ $disabilityType->id }}" type="checkbox"/>
                                        {{ $disabilityType->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="country_id"> País* </label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="country_id" id="country_id"
                                wire:model="country_id" x-ref="country_id"
                               >
                            <option value=""> SELECIONE </option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ convert_case($country->name, MB_CASE_UPPER) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-state_id">
                <div class="form-group">
                    <label for="state_id">Estado*</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="state_id" id="state_id"
                                wire:model="state_id" x-ref="state_id" wire:change="loadCities"
                               >
                            <option value="">SELECIONE</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">
                                    {{ convert_case($state->name, MB_CASE_UPPER) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3 {{ $this->detectIfCountryBrSelected() ? '':'d-none' }}" id="div-city_id">
                <div class="form-group">
                    <label for="city_id">Cidade*</label>
                    <div wire:ignore>
                        <select class="select2 form-control text-uppercase"
                                name="city_id" id="city_id"
                                wire:model="city_id" x-ref="city_id"
                                >
                            <option value="">SELECIONE</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id ?? $city['id'] }}">
                                    {{ mb_strtoupper($city->name ?? $city['name']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xl-3 {{ !$this->detectIfCountryBrSelected() ? '' : 'd-none' }}">
                <div class="form-group">
                    <label for="other_city">Cidade*</label>
                    <input type="text" class="form-control text-uppercase"
                           name="other_city" id="other_city" wire:model="other_city"
                        {{ !$this->detectIfCountryBrSelected() ? '' : 'disabled'  }} />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="full_name">Email*</label>
                    <input type="text" class="form-control text-uppercase"
                           name="email" id="email"
                           wire:model="email"
                    />
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="full_name">Confirmação de Email*</label>
                    <input type="text" class="form-control text-uppercase"
                           name="confirm_email" id="confirm_email"
                           wire:model="confirm_email"
                    />
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="full_name">Telefone (DD) + Número</label>
                    <input type="text" class="form-control text-uppercase"
                           name="mobile" id="mobile"
                           wire:model="mobile"
                    />
                </div>
            </div>


{{--            <div class="col-lg-12">--}}
{{--                <livewire:contacts.form :contacts="$this->contact" :person_id="$this->person_id" :modal="$this->modal" :readonly="$this->readonly" :is-visitors-form="true" />--}}
{{--            </div>--}}

            <div class="col-lg-6 col-xl-6">
{{--                @foreach($this->alerts as $alert)--}}
{{--                    <div class="col-12">--}}
{{--                        <span class="text-danger"><i class="fa fa-ban cog-faint" aria-hidden="true"></i> {{$alert }}</span>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>



        <div class="row">
            <div class="col-sm-4 align-self-center d-flex justify-content-end gap-4">
                <button wire:ignore="" class="btn btn-success text-white ml-1" id="submitButton" title="Salvar" onclick="this.disabled=true; this.form.submit();">
                    <i class="fa fa-save"></i> Solicitar
                </button>



                <a href="https://www.alerj.rj.gov.br/" id="cancelButton" title="Cancelar" class="btn btn-danger text-white ml-1">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
            </div>
        </div>
    </form>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            var blockedDates = @json($blockedDates);
            var flatpickrInstance = flatpickr("#reservation_date", {
                locale: "pt",
                dateFormat: "d/m/Y",
                minDate: "today",
                maxDate: new Date().fp_incr(30), // 30 days from now
                disable: blockedDates,
                onChange: function(selectedDates, dateStr, instance) {
                @this.set('reservation_date', dateStr);
                }
            });

            Livewire.on('blockedDatesUpdated', function(newBlockedDates) {
                flatpickrInstance.set('disable', newBlockedDates);
            });
        });


    </script>
</div>


