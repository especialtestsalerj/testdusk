@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="mb-0">Setores</h4>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('sectors.index') }}" id="searchForm">
                        @include(
                            'layouts.partials.search-form',
                            [
                                'routeSearch' => 'sectors.index',
                                'routeCreate' => 'sectors.create',
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('sectors.partials.table')
        </div>
    </div>
@endsection

