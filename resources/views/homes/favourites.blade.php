@extends ('layouts.master')

@section ('content')
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">My Favourite Houses</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Favourite Houses</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="new-properties bg-black-2">
        <div class="container">
            <div class="row">
                @foreach ($fav_houses as $fav_house)
                    <div class="col-lg-4">
                        <div class="property">
                            <div class="image">
                                <img src="{{ $fav_house->showFeaturedImage($path) }}" alt="{{ $fav_house->featuredImage()->image_name }}" class="img-fluid">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <a href="/houses/{{ $fav_house->id }}" class="btn btn-gradient btn-sm">View Details</a>
                                    <form class="delete" action="/favourite/{{ $fav_house->id }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm ml-3">Remove</button>>
                                    </form>
                                </div>
                            </div>
                            <div class="info">
                                <a href="#" class="no-anchor-style">
                                    <h3 class="h4 text-thin text-uppercase mb-1">{{ $fav_house->title }}</h3>
                                </a>
                                <ul class="tags list-inline">
                                    <li class="list-inline-item">
                                        <a href="#">{{ $fav_house->location->township }},</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            {{ $fav_house->location->region->name }}
                                        </a>
                                    </li>
                                </ul>
                                <div class="price text-primary text-capitalize">
                                    <strong class="mr-1">${{ $fav_house->price }}</strong><small>/{{ $fav_house->period }}</small>
                                </div>
                            </div>
                            <div class="statistics d-flex justify-content-between text-center">
                                <div class="item">
                                    <strong class="d-block">{{ $fav_house->houseDetail->bedrooms }}</strong>
                                    <span>Bedrooms</span>
                                </div>
                                <div class="item">
                                    <strong class="d-block">{{ $fav_house->houseDetail->bathrooms }}</strong>
                                    <span>Baths</span>
                                </div>
                                <div class="item">
                                    <strong class="d-block">{{ $fav_house->area }}</strong>
                                    <span>ft<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section ('js')
<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@endsection
