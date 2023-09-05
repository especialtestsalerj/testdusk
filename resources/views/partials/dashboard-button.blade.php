{{--<div class="col-6 col-lg-3">--}}
{{--    @can($permission)--}}
{{--    <a href="{{$url}}">--}}
{{--    @endcan--}}
{{--        <span @can($permission)class="fa-stack fa-3x dashboard-active-icons"@else class="fa-stack fa-3x dashboard-inactive-icons"@endcan @can($permission) @if(isset($count)) data-count="{{$count}}" @endIf @endcan>--}}
{{--            <i class="fa fa-circle fa-stack-2x"></i>--}}
{{--            <i class="fa {{$ico}} fa-stack-1x fa-inverse"></i>--}}
{{--        </span>--}}
{{--        <h5 class="mt-2">--}}
{{--            {{$title}}--}}
{{--        </h5>--}}
{{--    @can($permission)--}}
{{--    </a>--}}
{{--    @endcan--}}
{{--</div>--}}


@can($permission)
<div class="col-4">
    <a href="{{$url}}">
        <div class="px-0 px-lg-3 py-0 py-md-3 py-lg-0 mx-2 mx-lg-0 mx-xxl-5 mb-0 bg-button-home text-center shadow rounded" type="button">
            <div class="py-2 py-lg-5">
                <span class="fa-stack fa-5x dashboard-active-icons"@can($permission) @if(isset($count) && $count > 0) data-count="{{$count}}" @endIf @endcan>
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa {{$ico}} fa-stack-1x fa-inverse"></i>
                </span>
                <h5 class="mt-2 mt-lg-4 mt-xxl-4 fs-3 fw-bold">
                    {{$title}}
                </h5>
            </div>
        </div>
    </a>
</div>
@endcan

