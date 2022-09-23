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
                <input type="text" name="search" class="form-control" placeholder="Pesquisar..." wire:model.debounce.500ms="searchString" value="">
                <a class="btn btn-outline-secondary" type="button" title="Buscar" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </div>
</div>
