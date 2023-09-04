<div class="col-6 col-lg-3">
    @can($permission)
    <a href="{{$url}}" class="dashboard-button-swipper">
    @endcan
        <span @can($permission)class="fa-stack fa-3x dashboard-active-icons"@else class="fa-stack fa-3x dashboard-inactive-icons"@endcan @can($permission) @if(isset($count)) data-count="{{$count}}" @endIf @endcan>
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
