@extends ('homes.property.master')

@section ('heading')
    <h1 class="h2">Property List Sidebar</h1>
@endsection

@section ('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li aria-current="page" class="breadcrumb-item active">Property List Sidebar</li>
        </ol>
    </nav>
@endsection

@section ('filter')
<!-- Filters-->
<div class="filter d-flex justify-content-between align-items-center flex-wrap">
    <div class="sort d-flex align-items-center">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">Sort</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/property/list?sort=asc">Price (Low to Heigh)</a>
                <a class="dropdown-item" href="/property/list?sort=desc">Price (Heigh to Low)</a>
            </div>
        </div>
    </div>
    <div class="view d-flex align-items-center"><strong>View</strong>
        <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="/property" class="{{ isActiveURL('/property') }}"><i class="fa fa-th-large"></i></a></li>
            <li class="list-inline-item"><a href="/property/list" class="{{ isActiveURL('/property/list') }}"><i class="fa fa-th-list"></i></a></li>
        </ul>
    </div>
</div>
@endsection

@section ('listings')
<!-- Property Listings-->
<div class="property-listing col-lg-8">
    <div class="row">
        @foreach ($houses as $house)
            <div class="col-lg-12">
                <div class="property-listing-item">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 pr-lg-0">
                            <div class="image">
                                <img src="{{ $house->showFeaturedImage($path) }}" alt="{{ $house->featuredImage()->image_name }}" class="img-fluid">
                                <div class="price text-capitalize"><small>MMK {{ $house->price }}/{{$house->period}}</small></div>
                            </div> <!-- end image -->
                        </div> <!-- end col-lg-6 -->

                        <div class="col-lg-6 pl-lg-0">
                            <div class="inner bg-black-2 d-flex justify-content-center flex-column pd-lg-0">
                                <div class="info">
                                    @if (today()->month == $house->created_at->month)
                                        <div class="badge badge-success">New</div>
                                    @endif
                                    <a href="/houses/{{ $house->id }}" class="no-anchor-style">
                                        <h2 class="h3 text-thin"> {{ $house->title }}</h2>
                                    </a>
                                    <p class="address">{{ $house->location->address }}</p>
                                </div> <!-- end info -->

                                <div class="footer d-flex align-items-center justify-content-between">
                                    <div class="left">Area <span class="area">{{ $house->area }} </span> sq/ft</div>
                                    <div class="right">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><i class="fa fa-bed"></i>4</li>
                                            <li class="list-inline-item"><i class="fa fa-bath"></i>2</li>
                                        </ul>
                                    </div> <!-- end right -->
                                </div> <!-- end footer -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="property-listing-footer">
            <div class="mt-5">
                <nav aria-label="Page navigation example">
                    {{ $houses->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
