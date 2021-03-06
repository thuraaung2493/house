@extends ('layouts.master')

@section ('content')
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">Edit {{ $house->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/houses/{{ $house
                    ->id }}">{{ $house->title }}</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Submit Section-->
    <section class="submit-property bg-black-4">
        <div class="container">
            <!-- Basic Information -->
            <h2 class="h3 mb-4">Basic Information</h2>

            <form action="/houses/{{ $house->id }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                {{ csrf_field() }}

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Property Title *</label>
                        <input type="text" name="title" placeholder="Perfcet House For Rent" class="form-control" value="{{ old('title', $house->title) }}">

                        {{-- error msg --}}
                        @if ($errors->has('title'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Property Type *</label>
                        <select id="types" name="house_type_id" class="selectpicker">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('house_type_id', $house->house_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('house_type_id'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('house_type_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Rental Period *</label>
                        <select id="period" name="period" class="selectpicker">
                            <option value="month" {{ old('period', $house->period) == 'month' ? 'selected' : '' }}>Monthly</option>
                            <option value="year" {{ old('period', $house->period) == 'year' ? 'selected' : '' }}>Yearly</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('period'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('period') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Property Price *</label>
                        <input type="text" name="price" placeholder="MMK" class="form-control placeholder-right" value="{{ old('price', $house->price) }}" required>

                        {{-- error msg --}}
                        @if ($errors->has('price'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Property Area *</label>
                        <input type="text" name="area" placeholder="sqft" class="form-control placeholder-right" value="{{ old('area', $house->area) }}" required>

                        {{-- error msg --}}
                        @if ($errors->has('area'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Property Room *</label>
                        <select name="rooms" class="selectpicker">
                            <option value="1" {{ old('rooms', $house->rooms) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('rooms', $house->rooms) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('rooms', $house->rooms) == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('rooms', $house->rooms) == 4 ? 'selected' : '' }}>4</option>
                            <option value="more-than-5" {{ old('rooms', $house->rooms) == 'more-than-5' ? 'selected' : '' }}>More than 4</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('rooms'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('rooms') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Property Description *</label>
                        <textarea name="description" placeholder="description" class="form-control radius-sm">{{ old('description', $house->description) }}</textarea>

                        {{-- error msg --}}
                        @if ($errors->has('description'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="line mt-5 mb-5">

                <!-- Gallery -->
                <h2 class="h3 mb-4">Gallery</h2>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label class="pl-0 mb-3">Featured Image *</label>
                        <input type="file" name="feature_image" class="form-control radius-sm" onchange="previewFile();">

                        {{-- error msg --}}
                        @if ($errors->has('images'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('images') }}
                            </div>
                        @endif
                        {{-- Previous Image --}}
                        <div class="image-preview" id="image_previous">
                            <p class="template-text">Previous A Featured Image</p>
                            <img src="{{ $house->showFeaturedImage($path) }}" height="100px"  class="figure-img pr-3" alt="{{ $house->featuredImage()->image_name }}">
                        </div>
                        {{-- Preview --}}
                        <div id="image_preview" class="image-preview d-none">
                            <p class="template-text">No File Choosen</p>
                        </div>

                    </div>

                    <div class="form-group col-lg-7">
                        <label class="pl-0 mb-3">All Images *</label>
                        <input type="file" id="images" onchange="previewImages();" name="images[]" class="form-control radius-sm" multiple="multiple">

                        {{-- error msg --}}
                        @if ($errors->has('images'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('images') }}
                            </div>
                        @endif
                        {{-- Previous --}}
                        <div class="image-preview" id="images_previous">
                            <p class="template-text">Previous Images</p>
                            @foreach ($images as $image)
                                <img src="{{ $image->showImages($path) }}" height="100px"  class="figure-img pr-3" alt="{{ $image->image_name }}">
                            @endforeach
                        </div>
                        {{-- Preview --}}
                        <div id="images_preview" class="image-preview d-none">
                            <p class="template-text">No File Choosen</p>
                        </div>
                    </div>
                </div>
                <hr class="line mt-5 mb-5">

                <!-- Location -->
                <h2 class="h3 mb-4">Location</h2>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label>Friendly Address *</label>
                        <input type="text" name="address" class="form-control" placeholder="No, Street, Township, Region" value="{{ old('address', $house->location->address) }}" required>

                        {{-- error msg --}}
                        @if ($errors->has('address'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Street *</label>
                        <input type="text" name="street" class="form-control" placeholder="eg. Hledan" value="{{ old('street', $house->location->street) }}" required>

                        {{-- error msg --}}
                        @if ($errors->has('street'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('street') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Township *</label>
                        <input type="text" name="township" class="form-control" placeholder="eg. Kamayut" value="{{ old('township', $house->location->township) }}" required>

                        {{-- error msg --}}
                        @if ($errors->has('township'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('township') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Region *</label>
                        <select name="region" class="selectpicker">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region', $house->location->region_id) == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('region'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('region') }}
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="line mt-5 mb-5">

                <!-- Detailed Information -->
                <h2 class="h3 mb-4">Detailed Information</h2>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Building Year *</label>
                        <select name="building_year" class="selectpicker">
                            <option value="1990-1999" {{ old('building_year', $house->houseDetail->building_year) == '1990-1999' ? 'selected' : '' }}>1990 - 1999</option>
                            <option value="1999-2009" {{ old('building_year', $house->houseDetail->building_year) == '1999-2009' ? 'selected' : '' }}>1999 - 2009</option>
                            <option value="2009-2019" {{ old('building_year', $house->houseDetail->building_year) == '2009-2019' ? 'selected' : '' }}>2009 - 2019</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('building_year'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('building_year') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Bathrooms *</label>
                        <select name="bathrooms" class="selectpicker">
                            <option value="1" {{ old('bathrooms', $house->houseDetail->bathrooms) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('bathrooms', $house->houseDetail->bathrooms) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('bathrooms', $house->houseDetail->bathrooms) == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('bathrooms', $house->houseDetail->bathrooms) == 4 ? 'selected' : '' }}>4</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('bathrooms'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('bathrooms') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Bedrooms *</label>
                        <select name="bedrooms" class="selectpicker">
                            <option value="1" {{ old('bedrooms', $house->houseDetail->bedrooms) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('bedrooms', $house->houseDetail->bedrooms) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('bedrooms', $house->houseDetail->bedrooms) == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('bedrooms', $house->houseDetail->bedrooms) == 4 ? 'selected' : '' }}>4</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('bedrooms'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('bedrooms') }}
                            </div>
                        @endif
                    </div>
                    {{-- <div class="form-group col-lg-4">
                        <label>Lot Size *</label>
                        <input type="text" name="lot_size" placeholder="sqft" class="form-control placeholder-right">
                    </div> --}}
                    <div class="form-group col-lg-4">
                        <label>Parking *</label>
                        <select name="parking" class="selectpicker">
                            <option value="1" {{ old('parking', $house->houseDetail->parking) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('parking', $house->houseDetail->parking) == 0 ? 'selected' : '' }}>No</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('parking'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('parking') }}
                            </div>
                        @endif
                    </div>
                    {{-- <div class="form-group col-lg-4">
                        <label>Cooling *</label>
                        <input type="text" name="cooling" class="form-control">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Sewer *</label>
                        <input type="text" name="sewer" class="form-control">
                    </div> --}}

                    <div class="form-group col-lg-4">
                        <label>Water *</label>
                        <select name="water" class="selectpicker">
                            <option value="1" {{ old('water', $house->houseDetail->water) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('water', $house->houseDetail->water) == 0 ? 'selected' : '' }}>No</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('water'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('water') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Exercise Room *</label>
                        <select name="exercise_room" class="selectpicker">
                            <option value="1" {{ old('exercise_room', $house->houseDetail->exercise_room) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('exercise_room', $house->houseDetail->exercise_room) == 0 ? 'selected' : '' }}>No</option>
                        </select>

                        {{-- error msg --}}
                        @if ($errors->has('exercise_room'))
                            <div class="text-danger font-italic">
                                {{ $errors->first('exercise_room') }}
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="line mt-5 mb-5">

                <!-- Other Features-->
                <h2 class="h3 mb-4">Other Features</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="features ml-0">
                            <div class="form group">
                                @foreach ($features as $feature)
                                    <label for="{{ $feature->name }}" class="label-template-checkbox {{ in_array($feature->name, $house_features) ? 'active' : '' }}">{{ title_case($feature->name) }}
                                        <input type="checkbox" name="features[]" value="{{ $feature->name }}" id="{{ $feature->name }}" {{ in_array($feature->name, $house_features) ? 'checked' : '' }}>
                                    </label>
                                @endforeach

                                {{-- error msg --}}
                                @if ($errors->has('features'))
                                    <div class="text-danger font-italic">
                                        {{ $errors->first('features') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr class="line mt-5 mb-5"> --}}

                <!-- Floor Plan-->
                {{-- <h2 class="h3 mb-4">Plan</h2>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <div class="upload-btn-wrapper d-block"><i class="fa fa-image d-block"></i>Upload Plan Images
                            <input type="file" name="floor_images[]" multiple="multiple">
                        </div>
                    </div>
                </div> --}}
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-gradient wide">Update Property</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section ('js')
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
    <script src="{{ asset('js/submit-property-map.js')}}"></script> --}}
    <script>
        function previewFile() {
            $('#image_preview').removeClass('d-none');
            $('#image_previous').addClass('d-none');
            if($('#feature_image').length) {
                $('#feature_image').remove();
            }
            $('#image_preview > p').text("A feature image choosen");
            $('#image_preview').append("<img height='100px' id='feature_image' src='"+URL.createObjectURL(event.target.files[0])+"'>");
        }

        function previewImages() {
            $('#images_preview').removeClass('d-none');
            $('#images_previous').addClass('d-none');
            var total_file=document.getElementById("images").files.length;
            if($('.image').length) {
                $('.image').remove();
            }
            $('#images_preview > p').text(total_file + " images choosen");
            for(var i=0;i<total_file;i++) {
                $('#images_preview').append("<img height='100px' class='pr-3 image pt-3 pr-3' src='"+URL.createObjectURL(event.target.files[i])+"'>");
            }
        }
    </script>
@endsection

