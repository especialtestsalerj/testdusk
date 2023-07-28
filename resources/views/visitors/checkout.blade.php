@extends('layouts.app')

@section('content')
    <div class="py-4 px-4">

        <div class="row border-bottom border-dark mb-4 pb-2">
            <div class="col-md-8">
                <h3 class="mb-0">Visitas - Checkout de Visitante</h3>
            </div>
        </div>

        <div class="row g-5">

            <div class="col-md-3">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded text-center">
                        <h4 class="fst-italic">
                            Leitura de QR CODE
                        </h4>

                        <p class="display-1 mb-0">
                            <i class="fas fa-qrcode"></i>
                        </p>

                        <p class="mb-0">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur malesuada ex a varius congue. Pellentesque dolor tortor, tincidunt quis sagittis ut, mollis sed metus. Integer id ligula ex.
                        </p>

                        <div class="row d-flex justify-content-end mt-3">
                            <div class="d-grid gap-2 col-10 mx-auto">
                                <button class="btn btn-primary fw-bold" type="button">
                                    <i class="fas fa-qrcode me-3"></i>LER QR CODE
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            <div class="col-md-9">

                <div class="row mb-3">
                    <div class="col-4">
                        <input class="form-control" type="text" placeholder="Filtrar por nome" aria-label="default input example">
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Data de início</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Data de termino</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Mostrar </option>
                            <option value="1">5</option>
                            <option value="2">10</option>
                            <option value="3">20</option>
                            <option value="4">50</option>
                            <option value="5">100</option>
                            <option value="6">500</option>
                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=31" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                    Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                    Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=22" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=23" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=24" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=25" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=26" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=28" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="https://i.pravatar.cc/1000?img=29" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                Nome do Visitante Completo
                                                </strong>
                                            </div>
                                            <div class="col-12">
                                                Nome do Setor Visitado
                                                </strong>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Entrada |
                                                        <strong>
                                                            22/12/2023 - 17:50
                                                        </strong>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <div class="small fw-bold">
                                                        <i class="fas fa-calendar-day me-2"></i>Saída <strong> 22/12/2023 - 17:50</strong>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>





            </div>




        </div>

    </div>

    @include('partials.button-to-top')
@endsection
