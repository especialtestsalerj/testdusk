<div>
    @if(count($environment['app']['allowedBuildings']) > 1)
        <form method="POST" id="session-building-form" action="{{route('session.current-building')}}">
            @csrf
            <select id="session_building_id" name="session_building_id">
                @forEach($environment['app']['allowedBuildings'] as $building)
                    <option @if($building->id == get_current_building()->id) selected @endIf value="{{ $building->id}}">{{$building->name}}</option>
                @endForEach
            </select>
        </form>

        <script>
            var form = document.getElementById('session-building-form');
            var select = document.getElementById('session_building_id');

            select.addEventListener('change', function() {
                form.submit();
            });
        </script>
    @else
        {{ get_current_building()->name }}
    @endIf
</div>
