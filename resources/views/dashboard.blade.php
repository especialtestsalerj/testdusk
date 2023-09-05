@extends('layouts.app')

@section('content')

    <nav class="row mt-0 mb-3 bg-dark2 text-white">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active px-5" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                <h4>
                    Portaria
                </h4>
            </button>
            <button class="nav-link px-5" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                <h4>
                    Segurança
                </h4>
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div class="row d-flex justify-content-center mb-5">
                <div class="col-12 col-lg-8">
                    <div class="row g-0 g-lg-3 text-uppercase mt-3 d-flex justify-content-center">
                        <div class="col-4">
                            <a href="https://ocorrencias.test/people">
                                <div class="px-0 px-lg-3 py-0 py-md-3 py-lg-0 mx-2 mx-lg-0 mx-xxl-5 mb-0 bg-button-home text-center shadow rounded" type="button">
                                    <div class="py-2 py-lg-5">
                <span class="fa-stack fa-5x dashboard-active-icons">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                </span>
                                        <h5 class="mt-2 mt-lg-4 mt-xxl-4 fs-3 fw-bold">
                                            Pessoas
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-4">
                            <a href="https://ocorrencias.test/visitors">
                                <div class="px-0 px-lg-3 py-0 py-md-3 py-lg-0 mx-2 mx-lg-0 mx-xxl-5 mb-0 bg-button-home text-center shadow rounded" type="button">
                                    <div class="py-2 py-lg-5">
                <span class="fa-stack fa-5x dashboard-active-icons">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-people-roof fa-stack-1x fa-inverse"></i>
                </span>
                                        <h5 class="mt-2 mt-lg-4 mt-xxl-4 fs-3 fw-bold">
                                            Visitas
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-4">
                            <a href="https://ocorrencias.test/visitors/checkout">
                                <div class="px-0 px-lg-3 py-0 py-md-3 py-lg-0 mx-2 mx-lg-0 mx-xxl-5 mb-0 bg-button-home text-center shadow rounded" type="button">
                                    <div class="py-2 py-lg-5">
                <span class="fa-stack fa-5x dashboard-active-icons">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-arrow-up-right-from-square fa-stack-1x fa-inverse"></i>
                </span>
                                        <h5 class="mt-2 mt-lg-4 mt-xxl-4 fs-3 fw-bold">
                                            checkout
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-10">
                                <!-- Slider main container -->
                                <div dir="rtl" class="swiper mb-5 mt-lg-5 swiper-initialized swiper-horizontal swiper-pointer-events swiper-rtl">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide swiper-home swiper-slide-active" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/36?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 36
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-success">ABERTA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 22/06/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/36/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/36/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/36/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="5">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home swiper-slide-next" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/35?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 35
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 15/05/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/35/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/35/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/35/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/34?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 34
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 03/05/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/34/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/34/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/34/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/33?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 33
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 13/04/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/33/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/33/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/33/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/32?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 32
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 11/04/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/32/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/32/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/32/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/31?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 31
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 31/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/31/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/31/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/31/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/30?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 30
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 16/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/30/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/30/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/30/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="15">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/29?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 29
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 14/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/29/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/29/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/29/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="13">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/28?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 28
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 10/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/28/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/28/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/28/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/27?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 27
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 08/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/27/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/27/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/27/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="11">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/26?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 26
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 06/03/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/26/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/26/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/26/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="12">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/25?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 25
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 28/02/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/25/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/25/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/25/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="19">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/24?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 24
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 24/02/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/24/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/24/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="2">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/24/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-home" style="width: 1018px;">
                                            <div dir="ltr" class="col-12">
                                                <div class="card bg-white">
                                                    <div class="card-header">
                                                        <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <a href="https://ocorrencias.test/routines/23?redirect=dashboard">
                                                                        <i class="fa fa-clipboard-list"></i> Rotina 23
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                <h4>
                                                                    <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-calendar-day ms-lg-3"></i> 20/02/2023
                                                                </h4>
                                                            </div>
                                                            <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                <h4>
                                                                    <i class="fas fa-clock ms-lg-3"></i> 08:00 - 20:00
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body px-5 py-5 border-bottom rounded">
                                                        <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/23/events" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="1">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Ocorrências
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/23/stuffs" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Materiais
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 col-lg-3">
                                                                <a href="https://ocorrencias.test/routines/23/cautions" class="dashboard-button-swipper">
            <span class="fa-stack fa-3x dashboard-active-icons" data-count="0">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-person-rifle fa-stack-1x fa-inverse"></i>
        </span>
                                                                    <h5 class="mt-2">
                                                                        Cautelas de Armas
                                                                    </h5>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev swiper-button-disabled"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @canany(['visitors:show', 'people:show'])
        <!---------- NOVO LAYOUT DO PORTARIA - LARAVELIZAR ---------->
        <div class="row mt-0 mb-3 bg-dark2 text-white">
            <div class="col pt-2 ps-5">
                <h4>
                    Portaria
                </h4>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-12 col-lg-8">
                <div class="row g-0 g-lg-3 text-uppercase mt-3 d-flex justify-content-center">
                    @include('partials.dashboard-button', ['url' => route('people.index'), 'permission' => 'people:show', 'title' => 'Pessoas', 'ico' => 'fa-users'])
                    @include('partials.dashboard-button', ['url' => route('visitors.index'), 'permission' => 'visitors:show', 'title' => 'Visitas', 'ico' => 'fa-people-roof', 'count' => $pendingVisitors->count()])
                    @include('partials.dashboard-button', ['url' => route('visitors.checkout'), 'permission' => 'visitors:show', 'title' => 'checkout', 'ico' => 'fa-arrow-up-right-from-square'])
                </div>
            </div>
        </div>
        <!---------- FIM DO NOVO LAYOUT DO PORTARIA - LARAVELIZAR ---------->
    @endcanany

    <!---------- LAYOUT DO SEGURANCA  ---------->

    @can('routines:show')
        @if(!empty($routines))
            <div class="row mt-0 mb-3 bg-dark2 text-white">
                <div class="col pt-2 ps-5">
                    <h4>
                        Segurança
                    </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-10">
                                <!-- Slider main container -->
                                <div dir="rtl" class="swiper mb-5 mt-lg-5">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        @forelse ($routines as $routine)
                                            <div class="swiper-slide swiper-home">
                                                <div dir="ltr" class="col-12">
                                                    <div class="card bg-white">
                                                        <div class="card-header">
                                                            <div class="row mx-0 mx-lg-3 mt-3 mb-2">
                                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                    <h4>
                                                                        @can('routines:show')
                                                                            <a href="{{ route('routines.show', ['id' => $routine->id, 'redirect' => 'dashboard']) }}">
                                                                                <i class="fa fa-clipboard-list"></i> Rotina {{ $routine->code }}
                                                                            </a>
                                                                        @else
                                                                            Rotina {{ $routine?->code }}
                                                                        @endcan
                                                                    </h4>
                                                                </div>
                                                                <div class="col-6 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                                                                    <h4>
                                                                        @if ($routine->status)
                                                                            <span class="badge rounded-pill bg-success">ABERTA</span>
                                                                        @else
                                                                            <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                                                        @endif
                                                                    </h4>
                                                                </div>
                                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                    <h4>
                                                                        <i class="fas fa-calendar-day ms-lg-3"></i> {{ $routine?->entranced_at?->format('d/m/Y') ?? '-'}}
                                                                    </h4>
                                                                </div>
                                                                <div class="col-6 col-lg-3 text-center text-lg-start">
                                                                    <h4>
                                                                        <i class="fas fa-clock ms-lg-3"></i> {{ $routine?->shift?->name ?? '-' }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body px-5 py-5 border-bottom rounded">
                                                            <div class="row mt-3 mb-3 text-center d-flex justify-content-center">
                                                                @include('partials.dashboard-button-swipper', ['url' => route('events.index', $routine->id), 'permission' => 'events:show', 'title' => 'Ocorrências', 'ico' => 'fa-list-check', 'count' => $routine->events()->count()])
                                                                @include('partials.dashboard-button-swipper', ['url' => route('stuffs.index', $routine->id), 'permission' => 'stuffs:show', 'title' => 'Materiais', 'ico' => 'fa-dolly-box', 'count' => $routine->stuffs()->count()])
                                                                @include('partials.dashboard-button-swipper', ['url' => route('cautions.index', $routine->id), 'permission' => 'stuffs:show', 'title' => 'Cautelas de Armas', 'ico' => 'fa-person-rifle', 'count' => $routine->cautions()->count()])
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endCan
    <!-- Slider main container -->
    <!---------- FIM DO LAYOUT DO SEGURANCA  ---------->

@endsection
