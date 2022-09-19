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
                <input type="text" name="search" dusk="search-input" class="form-control" placeholder="Pesquisar..." aria-label="Campo de pesquisa com botão de buscar e limpar" value="{{ $search ?? '' }}">
                <a class="btn btn-outline-secondary" type="button" dusk="search-button" title="Buscar" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-search"></i></a>
                @if(isset($routeSearch))
                    <a href="{{ route($routeSearch) }}" class="btn btn-outline-secondary" type="button" title="Limpar pesquisa" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-eraser"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
