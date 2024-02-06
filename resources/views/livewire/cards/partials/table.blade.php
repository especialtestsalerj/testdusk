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
                            <div class="col-12 col-lg-8 text-center text-lg-start" data-label="Saída">
                                @if ($card->visitors->first())
                                    <span class="fw-bold"> Saída: </span>
                                    <span class="badge bg-warning text-black">EM ABERTO</span>

                                @endif
                            </div>
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Visita:</span> {{ convert_case($card->visitors->first()->person->name ?? 'NÃO POSSUI', MB_CASE_UPPER) }}
                            </div>
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Entrada:</span> {{ convert_case($card->visitors->first()?->entranced_at?->format('d/m/Y H:i') ?? 'NÃO POSSUI', MB_CASE_UPPER) }}
                            </div>
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Visita possui restrição de acesso:</span> {{ convert_case($card->visitors->first()?->person->restrictions->isNotEmpty() ? 'SIM' : 'NÃO' , MB_CASE_UPPER) }}
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
                            </div>
                        </div>
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
