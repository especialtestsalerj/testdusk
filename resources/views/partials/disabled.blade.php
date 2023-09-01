@cannot($permission)
    disabled="disabled"
@endCan

@if(request()->query('disabled'))
    disabled="disabled"
@endif
