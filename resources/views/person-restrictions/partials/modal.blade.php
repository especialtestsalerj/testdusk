<div class="modal fade" id="peopleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('people.create')}}">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Nova Pessoa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <span id="#webcam" class="d-none"></span>
            <div class="modal-body">
                 @livewire('people.people', ['person_id'=>null,
            'person' =>null, 'modal' => request()->query('disabled'),

            'readonly' => false, 'showRestrictions' => true, 'document_number'=> request()->query('document_number'),
            'document_type_id'=> request()->query('document_type_id'), 'full_name'=> request()->query('full_name')])
            </div>
                <input type="hidden" name="redirect" value="person-restrictions.create" />

            <div class="modal-footer">
                <button type="submit" class="btn btn-success text-white ml-1" title="Salvar Pessoa">
                    <i class="fa fa-save"></i> Salvar
                </button>
                <button type="button" class="btn btn-danger text-white ml-1" data-bs-dismiss="modal" title="Fechar formulário">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
