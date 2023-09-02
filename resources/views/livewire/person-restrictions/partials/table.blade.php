    <div class="row">
    <div class="col-md-12">
        @forelse ($personRestrictions as $personRestriction)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-6 text-center text-lg-start">
                                <span class="fw-bold">Pessoa:</span> {{ $personRestriction?->person?->name }} -
                                @foreach($personRestriction?->person->documents as $document)
                                    {{$document->documentType->name}}: {{$document->number}}
                                    @if($document->state?->initial)
                                        - {{$document->state->initial}}
                                    @endif
                                    &nbsp;
                                @endforeach
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Início:</span> {{ $personRestriction?->started_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-3 text-center text-lg-start">
                                <span class="fw-bold">Término:</span> {{ $personRestriction?->ended_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                            </div>
                            <div class="col-12 col-lg-10 text-center text-lg-start">
                                <span class="fw-bold">Mensagem:</span> {{ $personRestriction?->message }}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                <a href="{{ route('person-restrictions.show', ['id' => $personRestriction->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#person-restriction-delete-modal{{ $personRestriction->id }}" title="Remover">
                                    <i class="fa fa-lg fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="person-restriction-delete-modal{{ $personRestriction->id }}" tabindex="-1" aria-labelledby="deleteModalLabelPersonRestriction" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelSector"><i class="fa fa-trash"></i> Remoção de Restrição</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('person-restrictions.destroy', ['id' => $personRestriction->id]) }}" method="post">
                                @csrf
                                <input name="id" type="hidden" value="{{ $personRestriction->id }}">
                                <div class="form-group">
                                    <label for="started_at">Início</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="started_at" id="started_at" value="{{is_null(old('started_at')) ? $personRestriction->started_at?->format('Y-m-d H:i') : old('started_at')}}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="ended_at">Término</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="ended_at" id="ended_at" value="{{is_null(old('ended_at')) ? $personRestriction->ended_at?->format('Y-m-d H:i') : old('ended_at')}}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="message">Mensagem</label>
                                    <textarea class="form-control" name="message" id="message" rows="5" disabled>{{ is_null(old('message')) ? $personRestriction->message : old('message') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea class="form-control" name="description" id="description" rows="10" disabled>{{ is_null(old('description')) ? $personRestriction->description : old('description') }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm text-white close-modal"><i class="fa fa-check"></i> Remover</button>
                                    <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Restrição encontrada.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-4">{{ $personRestrictions->links() }}
        </div>
    </div>
</div>
