
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Setores</h2>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('sectors.index') }}" id="searchForm">
                        @include(
                            'livewire.partials.search-form',
                            [
                                'btnNovoLabel' => 'Novo',
                                'btnNovoTitle' => 'Novo Setor',
                                'routeSearch' => 'sectors.index',
                                'routeCreate' => 'sectors.create',
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @include('layouts.msg')


            <div class="cards-striped mx-3 mx-lg-0">
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-routine m-1">
                    <div class="card-body p-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-2 col-lg-1 text-center">
                                <label class="badge bg-success"> ATIVO </label>
                            </div>
                            <div class="col-8 col-lg-10"> Nome do Setor </div>
                            <div class="col-2 col-lg-1 text-center actions">
                                <a href="http://ocorrencias.test/sectors/2" class="btn btn-link py-0" title="Alterar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-link py-0" data-bs-toggle="modal" data-bs-target="#delete-modal2" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('livewire.sectors.partials.table')
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
