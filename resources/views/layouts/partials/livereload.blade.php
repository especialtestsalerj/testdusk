@if (config('app.env') == 'local')
    <script src="http://localhost:{{config('app.live_reload')}}/livereload.js"></script>
@endif
