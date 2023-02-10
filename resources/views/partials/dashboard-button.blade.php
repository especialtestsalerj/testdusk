<div class="col-6 col-lg-3">
    @can($permission)
    <a href="#">
    @endcan
        <span class="fa-stack fa-3x" @can($permission)data-count="{{$count}}"@endcan>
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa {{$img}} fa-stack-1x fa-inverse"></i>
        </span>
        <h5 class="mt-2">
            {{$title}}
        </h5>
    @can($permission)
    </a>
    @endcan
</div>
