<div class="col-6 col-lg-4">
    @can($permission)
    <a href="{{$url}}">
    @endcan
        <span @can($permission)class="fa-stack fa-3x"@else class="fa-stack fa-3x fa-disabled"@endcan @can($permission)data-count="{{$count}}"@endcan>
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa {{$ico}} fa-stack-1x fa-inverse"></i>
        </span>
        <h5 class="mt-2">
            {{$title}}
        </h5>
    @can($permission)
    </a>
    @endcan
</div>
