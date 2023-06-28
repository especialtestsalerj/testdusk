<div class="form-group">
    <div
        x-init="VMasker($refs.cpf).maskPattern(cpfmask);"
        x-data="{ isEditing: {{ !$modal ? 'true' : 'false' }}, cpfmask: '999.999.999-99'}"
        @focus-field.window="$refs[$event.detail.field].focus()"
    >
        <div class="row">

            <div class="form-group">

                <div class="col-md-12 d-flex align-items-end">

                    <div class="col-md-2">
                        <label for="document_type_id">Tipo de Documento - {{$document_type_id}}</label> CPF={{$this->cpf}}
                        <select name= "document_type_id" class="select2 form-control" wire:model="document_type_id"
                        x-ref="document_type_id">
                            <option value="">Selecione</option>
                            @foreach($documentTypes as $documentType)
                                <option value="{{$documentType->id}}"
                                 >{{$documentType->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input name="person_id" id="person_id" type="hidden" wire:model.defer="person_id">
                        <label for="cpf">Documento:</label>
                        <input
                            type="text"
                            class="form-control @error('cpf') is-invalid @endError"
                            name="cpf"
                            id="cpf"
                            wire:model.lazy="cpf"

                            x-ref="cpf"
                            wire:blur="searchDocumentNumber"
                            @if($modal) disabled @endif @if($readonly) readonly @endif
                        />
                    </div>
                    <div class="col-md-2">
                        <button type="button" wire:click="searchDocumentNumber" class="btn btn-outline-secondary" id="btn_buscar" @if($modal || $readonly) disabled @endif>
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label for="full_name">Nome Completo *</label>{{$full_name}}
                    <input
                        type="text"
                        class="form-control"
                        name="full_name"
                        id="full_name"
                        wire:model.defer="full_name"
                        @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="full_name">Nome Social</label>
                    <input
                        type="text"
                        class="form-control"
                        name="social_name"
                        id="social_name"
                        wire:model.defer="social_name"
                        @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-md-3">
                <div class="form-group">
                    <label for="full_name">País*</label> Country_id = {{$country_id}}
                    <select name="country_id" class="select2 form-control" wire:model="country_id">
                        <option value="">Selecione o país</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}"
                            >{{$country->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>


            @if($country_id == "" || $country_id = $country_br->id)
            <div class="col-md-3">
                <div class="form-group">
                    <label for="full_name">Estado</label>
                    <select name="state_id" class="select2 form-control">
                        <option value="">Selecione o país</option>
                        @foreach($states as $state)
                            <option value="{{$state->id}}">{{$state->initial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="full_name">Cidade</label>
                    <select name="city_id" class="select2 form-control">
                        <option value="">Selecione o país</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @else
            <div class="col-md-3">
                <div class="form-group">
                    <label for="full_name">Cidade*</label>
                    <input type="text" name="city" class="form-control" />

                </div>
            </div>
        @endif

        <div class="row">
            <div class="form-group">

                <div class="col-md-12">
                    <label for="origin">Origem (Visitante)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="origin"
                        id="origin"
                        wire:model.defer="origin"
                        @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @error('cpf')
        <small class="text-danger">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @endError

        @foreach($alerts as $alert)
            <small class="text-danger">
                <i class="fas fa-cancel"></i>
                {{ $alert }}
            </small>
        @endforeach
    </div>
</div>
