<div class="row">
    <div class="col-md-12">
        @forelse ($certificateTypes as $certificateType)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-8 text-center text-lg-start">
                                <span class="fw-bold">Nome:</span> {{ $certificateType->name }}
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-start">
                                <span class="fw-bold">Status:</span>
                                @if ($certificateType->status)
                                    <label class="badge bg-success"> ATIVO </label>
                                @else
                                    <label class="badge bg-danger"> INATIVO </label>
                                @endif
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                <a href="{{ route('certificate-types.show', ['id' => $certificateType->id]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                @if(!$certificateType->canDelete())
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#certificate-type-delete-modal{{ $certificateType->id }}" title="Remover">
                                        <i class="fa fa-lg fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="certificate-type-delete-modal{{ $certificateType->id }}" tabindex="-1" aria-labelledby="deleteModalLabelCertificateType" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelCertificateType"><i class="fas fa-trash"></i> Remoção de Tipo de Porte</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="{{ route('certificate-types.destroy', ['id' => $certificateType->id]) }}" method="post">
                                @csrf
                                <input name="id" type="hidden" value="{{ $certificateType->id }}">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" name="name" id="name" value="{{ $certificateType->name }}" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select form-control" name="status" id="status" disabled>
                                        <option value="{{ $certificateType->status }}" selected="selected">{{ ($certificateType->status ? 'ATIVO' : 'INATIVO') }}</option>
                                    </select>
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
                <i class="fa fa-exclamation-triangle"></i> Nenhum Tipo de Porte encontrado.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-4">{{ $certificateTypes->links() }}
        </div>
    </div>
</div>
