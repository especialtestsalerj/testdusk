{{ csrf_field() }}

<div class="form-group float-end">
    <div class="d-flex row justify-content-end">
        <div class="col-sm-4">
            @if (isset($routeCreate))
                <a id="novo" href="{{ route($routeCreate) }}" class="btn btn-outline-primary float-end" title="Novo/a">
                    <i class="fa fa-plus"></i> Novo/a
                </a>
            @endif
        </div>
        <div class="col-sm-8">
            <div class="input-group">

            </div>
        </div>
    </div>
</div>
