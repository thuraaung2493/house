@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1>House Details</h1>
    <ol class="breadcrumb">
        <li><a href="{{ checkRoute(route('admin.home'), route('host.home')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ checkRoute(route('houses.index'), route('host-houses.index')) }}">All Houses</a></li>
        <li><a href="#">Details</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <section class="content-header">
        <div class="panel panel-default panel-padding">
            <div class="panel-heading">
                <h3>{{ $house->title }} (Host - {{$house->user->name}})
                    @can ('update-house')
                        <a href="{{ checkRoute(route('admin-houses.edit', $house->id), route('host-houses.edit', $house->id)) }}" class="btn btn-primary btn-lg pull-right">Edit</a>
                    @endcan
                </h3>
                <p><i class="fa fa-map-marker"></i> {{$house->location->address}}</p>
            </div>
            {{-- <div class="panel-body"> --}}
                <table class="table table-striped">
                    <tr>
                        <th class="has-line"><h4>Property Images</h4></th>
                    </tr>
                    <tr>
                        <td>
                        @foreach ($house->galleries as $image)
                            <img class="img-thumbnail mr-3" width="150px" height="150px" src="{{ $image->showImages($thumbnails) }}" alt="{{$image->image_name}}">
                        @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="has-line"><h4>Property Details</h4></th>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <p><strong>Property ID</strong></p>
                                    <span>{{$house->id}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Property ID</strong></p>
                                    <span>{{$house->id}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Type of property</strong></p>
                                    <span>{{$house->houseType->type_name}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Price</strong></p>
                                    <span>{{$house->price}} MMK/{{$house->period}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Land area</strong></p>
                                    <span>{{$house->area}} sqft</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Bathrooms</strong></p>
                                    <span>{{$house->houseDetail->bathrooms}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Bedrooms</strong></p>
                                    <span>{{$house->houseDetail->bedrooms}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Year build</strong></p>
                                    <span>{{$house->houseDetail->building_year}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Parking</strong></p>
                                    <span>{{$house->houseDetail->parking == 1 ? 'Yes' : 'No'}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Water</strong></p>
                                    <span>{{$house->houseDetail->water == 1 ? 'Yes' : 'No'}}</span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p><strong>Exercise Room</strong></p>
                                    <span>{{$house->houseDetail->exercise_room == 1 ? 'Yes' : 'No'}}</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="has-line"><h4>Property Description</h4></th>
                    </tr>
                    <tr>
                        <td>{{ $house->description }}</td>
                    </tr>
                    <tr>
                        <th class="has-line"><h4>Property Features</h4></th>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                @foreach ($features as $feature)
                                <div class="col-md-3">
                                    <i class="fa fa-check-square"></i>&nbsp;&nbsp;
                                    <label>{{$feature}}</label>
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ checkRoute(route('houses.index'), route('host-houses.index')) }}" class="btn btn-danger btn-lg">Back</a>
                        </td>
                    </tr>
                </table>
            {{-- </div> --}}
        </div>
    </section>
@endsection
