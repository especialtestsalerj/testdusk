@extends('layouts.app')

@section('content')
<div class="row mt-5">
    <div class="col-12 col-lg-10 offset-lg-1">
        <!-- Slider main container -->
        <div dir="rtl" class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @forelse ($routines as $routine)
                <!-- todo pacheco criar loop e adicionar dados reais -->
                <div class="swiper-slide">
                    <div dir="ltr" class="col-12">
                        <div class="card bg-white">
                            <div class="card-header">
                                <div class="row mx-lg-3 mt-3 mb-2">
                                    <div class="col-3 text-center text-lg-start">
                                        <h4>
                                            Rotina {{$routine->id}}
                                        </h4>
                                    </div>
                                    <div class="col-3 text-center text-lg-start">
                                        <h4>
                                            <i class="fas fa-calendar-day ms-lg-3"></i> {{ $routine?->entranced_at?->format('d/m/Y') ?? '-'}}
                                        </h4>
                                    </div>
                                    <div class="col-3 text-center text-lg-start">
                                        <h4>
                                            <i class="fas fa-clock ms-lg-3"></i> {{ $routine?->shift?->name ?? '-' }}
                                        </h4>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center justify-content-lg-end">
                                        <h4>
                                        @if ($routine->status)
                                            <span class="badge rounded-pill bg-success">ABERTA</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">FINALIZADA</span>
                                        @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-5 py-5 border-bottom rounded">
                                <div class="row mt-3 mb-3 routine-icons text-center">
                                    <div class="col-6 col-lg-3">
                                        <span class="fa-stack fa-3x" data-count="{{$routine->events()->count()}}">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-list-check fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h5 class="mt-2">
                                            Ocorrências
                                        </h5>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <span class="fa-stack fa-3x" data-count="{{$routine->visitors()->count()}}">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-people-group fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h5 class="mt-2">
                                            Visitantes
                                        </h5>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <span class="fa-stack fa-3x" data-count="{{$routine->stuffs()->count()}}">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-dolly-box fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h5 class="mt-2">
                                            Materiais
                                        </h5>
                                    </div>
                                    <div class="col-6 col-lg-3">
                                        <span class="fa-stack fa-3x" data-count="{{$routine->cautions()->count()}}">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-gun fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h5 class="mt-2">
                                            Cautelas de Armas
                                        </h5>

                                    </div>
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



<div class="row justify-content-center my-5 routine-cards">








</div>
@endsection
