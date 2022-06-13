@cannot($permission)
    @if(!is_null(optional($model)->id))
        disabled="disabled"
    @endif
@endCan;
