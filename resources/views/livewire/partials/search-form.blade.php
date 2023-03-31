{{ csrf_field() }}

<div class="form-group float-end">
    <div class="d-flex row justify-content-end">

        <div class="col-8 col-md-8">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar..." wire:model.debounce.500ms="searchString" value="">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
                @if(isset($routeSearch))
                    <span class="input-group-text" onClick="javascript:document.getElementById('searchForm').submit();">
                        <a href="{{ route($routeSearch, $routeSearchParams ?? []) }}">
                            <i class="fas fa-eraser"></i>
                        </a>
                    </span>
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
