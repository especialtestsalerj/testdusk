@csrf

<div class="form-group">
    <div class="d-flex row justify-content-end mt-3 mt-lg-0">
        <div class="col-9 col-md-8 col-lg-10">
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
        @if (isset($routeCreate))
            <div class="col-3 col-md-4 col-lg-2">
                <a id="novo" href="{{ route($routeCreate, $routeCreateParams ?? []) }}" class="btn btn-primary text-white float-end" title="{{ $btnNovoTitle }}">
                    <i class="fa fa-plus"></i> {{ $btnNovoLabel }}
                </a>
            </div>
        @endif
    </div>
</div>
