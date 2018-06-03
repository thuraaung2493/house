@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1>Edit</h1>
    <ol class="breadcrumb">
        <li><a href="{{ checkRoute(route('admin.home'), route('host.home')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ checkRoute(route('houses.index'), route('host-houses.index')) }}">All Houses</a></li>
        <li><a href="#">Edit</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <section class="content">
        <form action="{{ checkRoute(route('admin-houses.update', $house->id), route('host-houses.update', $house->id)) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            {{csrf_field()}}

            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title has-line">Basic Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6 {{$errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">Property Title *</label>
                            <input type="text" name="title" id="title" value="{{old('title', $house->title)}}" class="form-control r-40"  required>
                            {{-- error msg --}}
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    {{$errors->first('title')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{$errors->has('type')}}">
                            <label for="type">Property Type *</label>
                            <select name="house_type_id" id="type" class="type form-control r-40">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}" {{old('type', $house->houseType->id) == $type->id ? 'selected' : '' }}>{{$type->type_name}}</option>
                                @endforeach
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    {{$errors->first('type')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3 {{$errors->has('period') ? 'has-error' : ''}}">
                            <label for="period">Property Period *</label>
                            <select name="period" id="period" class="form-control r-40">
                                <option value="month" {{old('month', $house->period) == 'month' ? 'selected' : ''}}>Monthly</option>
                                    <option value="year" {{old('year', $house->period) == 'year' ? 'selected' : ''}}>Yearly</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('period'))
                                <span class="help-block">
                                    {{$errors->first('period')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3 {{$errors->has('price') ? 'has-error' : ''}}">
                            <label for="price">Property Price(MMK) *</label>
                            <input type="text" class="form-control r-40" value="{{old('price', $house->price)}}" name="price">
                            {{-- error msg --}}
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    {{$errors->first('price')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3" {{$errors->has('area') ? 'has-error' : ''}}>
                            <label for="area">Property Area(sqft) *</label>
                            <input type="text" class="form-control r-40" value="{{old('area', $house->area)}}" name="area">
                            {{-- error msg --}}
                            @if ($errors->has('area'))
                                <span class="help-block">
                                    {{$errors->first('area')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3" {{$errors->has('rooms') ? 'has-error' : ''}}>
                            <label for="rooms">Property Room *</label>
                            <select name="rooms" id="rooms" class="form-control r-40">
                                <option value="1" {{ old('rooms', $house->rooms) == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('rooms', $house->rooms) == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('rooms', $house->rooms) == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('rooms', $house->rooms) == 4 ? 'selected' : '' }}>4</option>
                                <option value="more-than-5" {{ old('rooms', $house->rooms) == 'more-than-5' ? 'selected' : '' }}>More than 4</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('period'))
                                <span class="help-block">
                                    {{$errors->first('period')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Property Description *</label>
                            <textarea name="description" id="description" rows="5" class="form-control radius-sm">{{old('description', $house->description)}}</textarea>
                            {{-- error msg --}}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    {{$errors->first('description')}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div> <!-- box-primary -->
            </div>
            {{-- Gallery --}}
            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title has-line">Gallery</h3>
                    </div>
                    <div class="box-body">
                        {{-- Previous Image --}}
                        <div class="form-group col-md-12">
                            <label for="image-preview">Previous Images *</label>
                            <div class="image-preview border-black-light" id="image_previous">
                                @foreach ($house->galleries as $image)
                                    <img src="{{ $image->showImages($path) }}" height="100px"  class="figure-img pb-2 pr-3" alt="{{ $image->image_name }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('image') ? 'has-error' : ''}}">
                            <label for="featureImage">Featured Image *</label>
                            <input type="file" name="feature_image" id="featureImage" class="form-control" onchange="previewFile(event);">
                            {{-- Preview --}}
                            <div id="image_preview" class="image-preview border-black-light d-none">
                                <p class="font-2x">No File Choosen</p>
                            </div>
                            {{-- error msg --}}
                            @if ($errors->has('feature_image'))
                                <span class="help-block">
                                    {{$errors->first('feature_image')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-8 {{$errors->has('images') ? 'has-error' : ''}}">
                            <label for="images">All Images *</label>
                            <input type="file" name="images[]" multiple="multiple" id="images" class="form-control" onchange="previewImages(event);">
                            {{-- Preview --}}
                            <div id="images_preview" class="image-preview border-black-light d-none">
                                <p class="font-2x">No File Choosen</p>
                            </div>
                            {{-- error msg --}}
                            @if ($errors->has('images'))
                                <span class="help-block">
                                    {{$errors->first('images')}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div> <!-- box-primary -->
            </div>
            {{-- Location --}}
            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title has-line">Location</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-12 {{$errors->has('address') ? 'has-error' : ''}}">
                            <label for="address">Friendly Address *</label>
                            <input type="text" class="form-control r-40" name="address" id="address" value="{{old('address', $house->location->address)}}">
                            {{-- error msg --}}
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    {{$errors->first('address')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4 {{$errors->has('street') ? 'has-error' : ''}}">
                            <label for="street">Street *</label>
                            <input type="text" class="form-control r-40" name="street" id="street" value="{{old('street', $house->location->street)}}">
                            {{-- error msg --}}
                            @if ($errors->has('street'))
                                <span class="help-block">
                                    {{$errors->first('street')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4 {{$errors->has('township') ? 'has-error' : ''}}">
                            <label for="township">Township *</label>
                            <input type="text" class="form-control r-40" name="township" id="township" value="{{old('township', $house->location->township)}}">
                            {{-- error msg --}}
                            @if ($errors->has('township'))
                                <span class="help-block">
                                    {{$errors->first('township')}}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4 {{$errors->has('region') ? 'has-error' : ''}}">
                            <label for="region">Region *</label>
                            <select name="region" id="region" class="form-control r-40">
                                @foreach ($regions as $region)
                                    <option value="{{$region->id}}" {{old('region', $house->location->region_id)  == $region->id ? 'selected' : ''}}>{{$region->name}}</option>
                                @endforeach
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('region'))
                                <span class="help-block">
                                    {{$errors->first('region')}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div> <!-- box-primary -->
            </div>
            {{-- Detail Information --}}
            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title has-line">Detailed Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4 {{$errors->has('') ? 'has-error' : ''}}">
                            <label for="year">Building Year(Optional) *</label>
                            <input type="text" class="form-control r-40" name="building_year" id="year" value="{{old('building_year', $house->houseDetail->building_year)}}">
                            {{-- error msg --}}
                            @if ($errors->has('building_year'))
                                <span class="help-block">
                                    {{$errors->first('building_year')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('bathrooms') ? 'has-error' : ''}}">
                            <label for="bathrooms">Bathrooms *</label>
                            <select name="bathrooms" class="form-control r-40" id="bathrooms">
                                <option value="1" {{ old('bathrooms', $house->houseDetail->bathrooms) == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('bathrooms', $house->houseDetail->bathrooms) == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('bathrooms', $house->houseDetail->bathrooms) == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('bathrooms', $house->houseDetail->bathrooms) == 4 ? 'selected' : '' }}>4</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('bathrooms'))
                                <span class="help-block">
                                    {{$errors->first('bathrooms')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('bedrooms') ? 'has-error' : ''}}">
                            <label for="bedrooms">Bedrooms *</label>
                            <select name="bedrooms" class="form-control r-40" id="bedrooms">
                                <option value="1" {{ old('bedrooms', $house->houseDetail->bedrooms) == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('bedrooms', $house->houseDetail->bedrooms) == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('bedrooms', $house->houseDetail->bedrooms) == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('bedrooms', $house->houseDetail->bedrooms) == 4 ? 'selected' : ''}}>4</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('bedrooms'))
                                <span class="help-block">
                                    {{$errors->first('bedrooms')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('parking') ? 'has-error' : ''}}">
                            <label for="parking">Parking *</label>
                            <select name="parking" class="form-control r-40" id="parking">
                                <option value="1" {{ old('parking', $house->houseDetail->parking) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('parking', $house->houseDetail->parking) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('parking'))
                                <span class="help-block">
                                    {{$errors->first('parking')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('water') ? 'has-error' : ''}}">
                            <label for="water">Water *</label>
                            <select name="water" class="form-control r-40" id="water">
                                <option value="1" {{ old('water', $house->houseDetail->water) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('water', $house->houseDetail->water) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('water'))
                                <span class="help-block">
                                    {{$errors->first('water')}}
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 {{$errors->has('exercise_room') ? 'has-error' : ''}}">
                            <label for="exercise_room">Exercise Room *</label>
                            <select name="exercise_room" class="form-control r-40" id="exercise_room">
                                <option value="1" {{ old('exercise_room', $house->houseDetail->exercise_room) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('exercise_room', $house->houseDetail->exercise_room) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            {{-- error msg --}}
                            @if ($errors->has('exercise_room'))
                                <span class="help-block">
                                    {{$errors->first('exercise_room')}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Features --}}
            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title has-line">Other Features</h3>
                    </div>
                    <div class="box-body">
                        @foreach ($all_features as $all_feature)
                            <label class="pr-3"><input type="checkbox" name="features[]" value="{{old('features', $all_feature->name)}}" {{ in_array($all_feature->name, $features) ? 'checked' : ''}}>&nbsp;&nbsp; {{title_case($all_feature->name)}}</label>
                        @endforeach
                        {{-- error msg --}}
                        @if($errors->has('features'))
                            <span class="help-block">
                                {{$errors->first('features')}}
                            </span>
                        @endif
                        <div class="form-group">
                            <button class="btn btn-primary mr-3 mt-3">UPDATE PROPERTY</button>
                            <a href="{{url()->previous()}}" class="btn btn-danger mt-3">CANCEL</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section ('js')
    <script>
        function previewFile() {
            $('#image_preview').removeClass('d-none');
            if($('#feature_image').length) {
                $('#feature_image').remove();
            }
            $('#image_preview > p').text("A feature image choosen");
            $('#image_preview').append("<img height='100px' id='feature_image' src='"+URL.createObjectURL(event.target.files[0])+"'>");
        }

        function previewImages() {
            $('#images_preview').removeClass('d-none');
            var total_file=document.getElementById("images").files.length;
            if($('.image').length) {
                $('.image').remove();
            }
            $('#images_preview > p').text(total_file + " images choosen");
            for(var i=0;i<total_file;i++) {
                $('#images_preview').append("<img height='100px' class='pb-2 pr-3 image pt-3 pr-3' src='"+URL.createObjectURL(event.target.files[i])+"'>");
            }
        }
    </script>
@endsection
