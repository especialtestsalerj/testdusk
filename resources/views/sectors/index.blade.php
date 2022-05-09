@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Setores</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('sectors.create') }}"> Novo</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="row">
                <div class="col-lg-12 mt-2 margin-tb">
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            </div>
        @endif

        <table class="table table-bordered mt-2">
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-6">Nome</th>
                <th class="col-md-2">Status</th>
                <th class="col-md-3"></th>
            </tr>
            @foreach ($sectors as $sector)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $sector->name }}</td>
                    <td>{{ $sector->status }}</td>
                    <td>
                        <form action="{{ route('sectors.destroy',$sector->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('sectors.show',$sector->id) }}">Detalhar</a>

                            <a class="btn btn-primary" href="{{ route('sectors.edit',$sector->id) }}">Alterar</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $sectors->links() !!}

@endsection
