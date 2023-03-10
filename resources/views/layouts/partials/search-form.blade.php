{{ csrf_field() }}

<div class="form-group float-end">
    <div class="d-flex row justify-content-end">
        <div class="col-8 col-md-8">
            <div class="input-group">
                <input type="text" name="search" dusk="search-input" class="form-control" placeholder="Pesquisar..." aria-label="Campo de pesquisa com botão de buscar e limpar" value="{{ $search ?? '' }}">
                <a class="btn btn-outline-secondary" type="button" dusk="search-button" title="Buscar" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-search"></i></a>
                @if(isset($routeSearch))
                    <a href="{{ route($routeSearch, $routeSearchParams ?? []) }}" class="btn btn-outline-secondary" type="button" title="Limpar pesquisa" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-eraser"></i></a>
                @endif
            </div>
        </div>
        <div class="col-4 col-md-4">
            @if (isset($routeCreate))
                <a id="novo" href="{{ route($routeCreate, $routeCreateParams ?? []) }}" class="btn btn-primary text-white float-end" title="{{ $btnNovoTitle }}">
                    <i class="fa fa-plus"></i> {{ $btnNovoLabel }}
                </a>
            @endif
        </div>
    </div>
</div>
