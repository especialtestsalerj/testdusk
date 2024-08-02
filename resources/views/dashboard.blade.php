@extends('layouts.booking-opensite')

@section('content')

    <div class="d-flex justify-content-center align-items-center vh-100">



        <div class="mt-n5">


            <div class="row mb-3  flex justify-content-center mt-n5">
                <div class="col-12 flex justify-content-center text-center">


                    <div class="w-25 flex justify-content-center">
                        <div>
                            <img src="img/logo.png" class="">
                        </div>

                    </div>


                </div>
            </div>

            <div class="row mt-5">


                <div class="col-6 text-center">

                    <button type="button" class="btn btn-light btn-lg px-5 py-5">
                        <i class="fa-solid fa-calendar-plus fa-2xl"></i>
                        <div class="mt-3">
                            Agendar
                        </div>

                    </button>

                </div>
                <div class="col-6 text-center">


                    <button type="button" class="btn btn-light btn-lg px-5 py-5">
                        <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                        <div class="mt-3">
                            Consultar
                        </div>

                    </button>



                </div>
            </div>

        </div>
    </div>




@endsection
