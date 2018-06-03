<!-- New house Section-->
<section class="new-properties bg-black-3" id="newHouse">
    <div class="container">
        <header class="text-center">
            <h2>New houses <span class="text-primary">for rent</span></h2>
            <div class="row">
                <p class="template-text col-lg-8 mx-auto">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</p>
            </div>
        </header>

        <div class="row">

            @foreach ($recent_houses as $recent_house)
            <div class="col-lg-4">
                <div class="property mb-5 mb-lg-0">
                    <div class="image">
                        <img src="{{ $recent_house->showFeaturedImage($path) }}" alt="{{ $recent_house->featuredImage()->image_name }}" class="img-fluid">
                        <div class="overlay d-flex align-items-center justify-content-center"><a href="houses/{{ $recent_house->id }}" class="btn btn-gradient btn-sm">View Details</a></div>
                    </div>
                    <div class="info">
                        <a href="houses/{{ $recent_house->id }}" class="no-anchor-style">
                        <h3 class="h4 text-thin text-uppercase mb-1">{{ $recent_house->title }}</h3></a>
                        <ul class="tags list-inline">
                            <li class="list-inline-item">
                                <a href="/houses/townships/{{$recent_house->location->township}}">
                                    {{ $recent_house->location->township}},
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/houses/regions/{{$recent_house->location->region_id}}">
                                    {{ $recent_house->location->region->name }}
                                </a>
                            </li>
                        </ul>
                        <div class="price text-primary">
                            <strong class="mr-1">${{ $recent_house->price }}</strong>
                        </div>
                    </div>
                    <div class="statistics d-flex justify-content-between text-center">
                        <div class="item"><strong class="d-block">{{ $recent_house->houseDetail->bedrooms }}</strong><span>Bedrooms</span></div>
                        <div class="item"><strong class="d-block">{{ $recent_house->houseDetail->bathrooms }}</strong><span>Baths</span></div>
                        <div class="item"><strong class="d-block">{{ $recent_house->area }}</strong><span>ft<sup>2</sup></span></div>
                    </div>
                    <div class="property-footer d-flex justify-content-between align-items-center">
                        <a href="#" class="user d-flex align-items-center no-anchor-style">
                            <div class="avatar">
                                <img src="{{ asset('img/default-user.png') }}" alt="{{$recent_house->user->name}}" class="img-fluid">
                            </div>
                            <div class="text">
                                <strong class="d-block">{{$recent_house->user->name}}</strong>
                                <span>{{ $recent_house->created_at->toFormattedDateString() }}</span>
                            </div>
                        </a>
                        <a href="/favourite/{{ $recent_house->id }}" class="favourite no-anchor-style"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
