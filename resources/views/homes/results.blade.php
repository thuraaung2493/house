@extends ('homes.property.master')

@section ('heading')
    <h1 class="h2">{{ ($numOfHouses == 1) ? 'Result' : 'Results' }}</h1>
@endsection

@section ('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Search</li>
        </ol>
    </nav>
@endsection

@section ('listings')
<!-- Property Listings-->
<div class="property-listing col-lg-8">
    <div class="row">
        @foreach ($results as $result)
        @if(!empty($result->house))
            <div class="col-lg-6">
                <div class="property-listing-item">
                    <div class="image">
                        <img src="{{$result->house->showFeaturedImage($path)}}" alt="{{ $result->house->featuredImage()->image_name }}" class="img-fluid">
                        <div class="price text-capitalize">
                            <small>MMK {{ $result->house->price }}/{{$result->house->period}}</small>
                        </div>
                    </div>
                    <div class="info">
                        @if (today()->month == $result->house->created_at->month)
                            <div class="badge badge-success">New</div>
                        @endif
                        <a href="/houses/{{ $result->house->id }}" class="no-anchor-style">
                          <h2 class="h3 text-thin">{{ $result->house->title }}</h2>
                        </a>
                        <p class="address">{{ $result->address }}</p>
                    </div>
                    <div class="footer d-flex align-items-center justify-content-between">
                        <div class="left">Area <span class="area">{{ $result->house->area }} </span> sq/ft</div>
                        <div class="right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><i class="fa fa-bed"></i>{{ $result->house->houseDetail->bedrooms }}</li>
                                <li class="list-inline-item"><i class="fa fa-bath"></i>{{ $result->house->houseDetail->bathrooms }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div> <!-- end of row -->
</div>
@endsection
