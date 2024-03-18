<div class="row">
    @forelse($contacts as $contact)
        <div class="col-md-12">
            <div class="cards-striped mx-lg-0 mt-lg-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Tipo:</span> {{$contact->contactType->name}}
                            </div>
                            <div class="col-12 col-lg-4 text-center text-lg-start">
                                <span class="fw-bold">Contato:</span> {{$contact->contactMaskered}}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Status:</span>
                                @if ($contact->status)
                                    <label class="badge bg-success"> ATIVO </label>
                                @else
                                    <label class="badge bg-danger"> INATIVO </label>
                                @endif
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-end">
                                @if(!request()->query('disabled'))
                                    <span class="btn btn-link"
                                          wire:click="editContact({{$contact->id}})"
                                          data-bs-toggle="modal" data-bs-target="#contact-modal"
                                          title="Alterar Contato">
                                                        <i class="fa fa-lg fa-pencil"></i>
                                                        </span>
                                    <span class="btn btn-link"
                                          wire:click="prepareForDeleteContact({{$contact}})"
                                          title="Remover Contato">
                                                        <i class="fa fa-lg fa-trash"></i>
                                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12">
            <div class="alert alert-warning mt-2">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhum contato encontrado.
            </div>
        </div>
    @endforelse

</div>
