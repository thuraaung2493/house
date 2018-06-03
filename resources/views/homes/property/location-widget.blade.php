<div class="widget location-widget">
    {{-- <div class="widget-header d-flex">
        <strong class="has-line">Regions</strong>
        <strong class="has-line">Townships</strong>
    </div> --}}
    <div class="d-flex">
        <ul class="list-unstyled mb-0">
            <p class="has-line text-white"><strong>Regions</strong></p>
            @foreach ($regions as $region)
                <li><a href="/houses/regions/{{$region->id}}">{{ $region->name }}</a></li>
            @endforeach
        </ul>
        <ul class="list-unstyled mb-0">
            <p class="has-line text-white"><strong>Townships</strong></p>
            @foreach ($locations as $location)
                <li><a href="/houses/townships/{{ preg_replace('/\s+/', '', $location->township) }}">{{ $location->township }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
