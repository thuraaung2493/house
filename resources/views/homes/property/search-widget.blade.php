<div class="widget search-widget">
    <div class="widget-header"><strong class="has-line">Search for Properties</strong></div>

    <form class="sidebar-search" action="/search" method="get">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="text" name="address" placeholder="Type your address..." class="form-control">
        </div>

        <div class="form-group">
            <select name="region_id" title="Region" class="selectpicker">
                @foreach ($regions as $region)
                    <option value="{{$region->id}}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select name="type_id" title="Property Type" class="selectpicker">
                @foreach ($types as $type)
                    <option value="{{$type->id}}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="min_price" placeholder="Min Price [USD]" class="form-control">
        </div>

         <div class="form-group">
            <input type="text" name="max_price" placeholder="Max Price [USD]" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="min_area_range" placeholder="Min area range [sq m]" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="max_area_range" placeholder="Max area range [sq m]" class="form-control">
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-gradient full-width">Search Property</button>
        </div>
    </form>
</div>
