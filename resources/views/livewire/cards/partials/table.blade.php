<div class="row">
    <div class="col-md-12">
        @forelse ($cards as $card)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Número:</span> {{ $card->number }}
                            </div>
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Unidade:</span> {{ convert_case($card->building->name, MB_CASE_UPPER) }}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Status:</span>
                                @if ($card->status)
                                    <label class="badge bg-success"> ATIVO </label>
                                @else
                                    <label class="badge bg-danger"> INATIVO </label>
                                @endif
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                @can(make_ability_name_with_current_building('cards:update'))
                                <a href="{{ route('cards.show', ['id' => $card->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                @endCan
                                @can(make_ability_name_with_current_building('cards:destroy'))
                                    @if(!$card->canDelete())
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#sector-delete-modal{{ $card->id }}" title="Remover">
                                            <i class="fa fa-lg fa-trash"></i>
                                        </button>
                                    @endif
                                @endCan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="sector-delete-modal{{ $card->id }}" tabindex="-1" aria-labelledby="deleteModalLabelSector" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form" action="{{ route('cards.destroy', ['id' => $card->id]) }}" method="post">
                            @csrf
                            <input name="id" type="hidden" value="{{ $card->id }}">

                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabelSector"><i class="fa fa-trash"></i> Remoção de Setor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" name="name" id="name" value="{{ $card->number }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Unidade</label>
                                    <input class="form-control" name="building" id="building" value="{{ $card->building->name }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select form-control" name="status" id="status" disabled>
                                        <option value="{{ $card->status }}" selected="selected">{{ ($card->status ? 'ATIVO' : 'INATIVO') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="submitRemoverSetor" title="Remover Setor"><i class="fa fa-check"></i> Remover</button>
                                <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar Formulário"><i class="fas fa-ban"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhum Cartão encontrado.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-4">{{ $cards->links() }}
        </div>
    </div>
</div>
