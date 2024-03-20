<div
    x-init=""
    x-data=""
    @focus-field.window="if($refs[$event.detail.field]) {$refs[$event.detail.field].focus()}"
    @change-contact-mask.window="
     setTimeout(() => {
        // console.log($event); console.log($refs[$event.detail.ref]);
        if($refs[$event.detail.ref]) {
            if($event.detail.mask){
                //console.log('changed mask of '+$refs[$event.detail.ref]+' to '+$event.detail.mask)
                VMasker($refs[$event.detail.ref]).maskPattern($event.detail.mask);
            }else{
                var fieldValue = $refs[$event.detail.ref].value;
                VMasker($refs[$event.detail.ref]).unMask();

                // Set the stored value back into the input field
                $refs[$event.detail.ref].value = fieldValue;
            }
         }
        }, 500);
     "
    class="row">
    <div class="{{$isVisitorsForm ? 'col-md-6' : 'col-12'}}">
        <div class="form-group">
            <label for="contact_type_id">Tipo de Contato{{$isRequired ? '*' : ''}}</label>
            <select class="form-select text-uppercase" name="contact_type_id"
                    id="contact_type_id" wire:model="contact_type_id"
                    x-ref="contact_type_id" @include('partials.disabled-by-query-string')>
                @if($isVisitorsForm)
                    <option value="">{{$isRequired ? 'SELECIONE' : ''}}</option>
                @else
                    <option value="">SELECIONE</option>
                @endif
                @foreach ($contactTypes as $contactType)
                    <option
                        value="{{ $contactType->id }}"> {{ $contactType->name }}</option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="contact">Contato{{$isRequired ? '*' : ''}}</label>
            <input class="form-control"
                   name="contact" id="contact"
                   wire:model="contact" x-ref="contact"
                   @include('partials.disabled-by-query-string') type="text"/>
        </div>
    </div>

    <div class="form-group" @if($isVisitorsForm) hidden @endif>
        <label for="status">Status*</label>
        <div class="form-check">
            <input class="form-check-input" wire:model="status" type="checkbox" id="status" name="status">
            <label class="form-check-label" for="status">Ativo</label>
        </div>
    </div>

</div>
