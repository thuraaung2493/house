<section class="search-property bg-black-4">
    <div class="container">
        <form action="/search" method="get">
            {{ csrf_field() }}

            <div class="row justify-content-center">
                <div class="form-group col-xl-7 col-lg-6">
                    <input type="text" name="address" placeholder="Enter address e.g. street, township and region" class="form-control">
                </div>

                <div class="form-group col-xl-1 col-lg-2">
                    <a href="#" class="more-filters btn btn-gradient full-width">
                        <i class="fa fa-sliders"></i>
                    </a>
                </div>
                <div class="form-group col-lg-2">
                    <button type="submit" class="submit btn btn-gradient full-width">Search</button>
                </div>
            </div>

            <div class="row all-options d-none">
                <div class="form-group col-lg-4">
                    <input type="text" name="min_price" placeholder="Min Price [USD]" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <input type="text" name="max_price" placeholder="Max Price [USD]" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <select id="Types" name="type_id" title="Property Type" class="selectpicker">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <input type="text" name="min_area_range" placeholder="Min area range [sq m]" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <input type="text" name="max_area_range" placeholder="Max area range [sq m]" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <select name="region_id" title="Regions" class="selectpicker">
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
               {{--  <div class="form group col-lg-12">
                    <label for="air_conditioning" class="label-template-checkbox">Air Conditioning
                        <input type="checkbox" name="air_conditioning" id="air_conditioning">
                    </label>
                    <label for="alarm" class="label-template-checkbox">Alarm
                        <input type="checkbox" name="alarm" id="alarm">
                    </label>
                    <label for="central_heating" class="label-template-checkbox">Central Heating
                        <input type="checkbox" name="central_heating" id="central_heating">
                    </label>
                    <label for="gym" class="label-template-checkbox">Gym
                        <input type="checkbox" name="gym" id="gym">
                    </label>
                    <label for="internet" class="label-template-checkbox">Internet
                        <input type="checkbox" name="internet" id="internet">
                    </label>
                    <label for="laundry_room" class="label-template-checkbox">Laundry Room
                        <input type="checkbox" name="laundry_room" id="laundry_room">
                    </label>
                    <label for="swimming_pool" class="label-template-checkbox">Swimming Pool
                        <input type="checkbox" name="swimming_pool" id="swimming_pool">
                    </label>
                </div> --}}
            </div>
        </form>
    </div>
</section>
