<div class="col-md-6 mb-2">
    <div class="row my-2">
        <div class="col-sm-8 align-self-center">
            <h3 class="mb-0"><i class="fa-solid fa-address-book"></i>
                Contatos
            </h3>
        </div>
        <div class="col-sm-4 align-self-center d-flex justify-content-end">
            @if(!request()->query('disabled'))
                <span class="btn btn-sm btn-primary text-white"
                      data-bs-toggle="modal" data-bs-target="#contact-modal"
                      title="Novo Contato">
                                            <i class="fa fa-plus"></i>
                </span>
            @endif
        </div>
    </div>

    @include('livewire.contacts.partials.table')

    <livewire:contacts.modal :person_id="$person->id"/>

</div>
