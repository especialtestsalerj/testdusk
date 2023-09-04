<div class="modal fade" id="peopleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                 @livewire('people.people', ['person_id'=>empty(request()->get('person_id')) ? $visitor->person_id  : request()->get('person_id'),
            'person' => $visitor->person, 'visitor_id'=>$visitor->id, 'mode' => $mode, 'modal' => request()->query('disabled'),
            'readonly' => $visitor->hasPending(), 'showRestrictions' => true, 'document_number'=> request()->query('document_number'),
            'document_type_id'=> request()->query('document_type_id'), 'full_name'=> request()->query('full_name')])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
