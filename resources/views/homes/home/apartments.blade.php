<!-- Apartments Section-->
<section class="apartments pt-0 bg-black-3" id="apartments">
    <div class="container">
        <header class="text-center">
            <h2>Apartments <span class="text-primary">ready</span></h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p class="template-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.</p>
                </div>
            </div>
        </header>
        <div class="swiper-container apartments-slider">
            <div class="swiper-wrapper pt-2 pb-5">
                @foreach ($apartments as $apartment)
                    <div class="swiper-slide">
                        <div class="property">
                            <div class="image">
                                @foreach ($apartment->galleries as $image)
                                    <img src="{{ $apartment->showFeaturedImage($path) }}" alt="{{ $apartment->featuredImage()->image_name }}" class="img-fluid">
                                @endforeach
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <a href="/houses/{{ $apartment->id }}" class="btn btn-gradient btn-sm">View Details</a>
                                </div>
                            </div>
                            <div class="info">
                                <a href="houses/{{ $apartment->id }}" class="no-anchor-style">
                                    <h3 class="h4 text-thin text-uppercase mb-1">{{ $apartment->title }}</h3>
                                </a>
                                <ul class="tags list-inline">
                                    <li class="list-inline-item">
                                        <a href="#">{{ $apartment->location->township }},</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#">
                                            {{ $apartment->location->region->name }}
                                        </a>
                                    </li>
                                </ul>
                                <div class="price text-primary text-capitalize"><strong class="mr-1">${{ $apartment->price }}</strong><small>/ {{ $apartment->period }}</small></div>
                            </div>
                            <div class="statistics d-flex justify-content-between text-center">
                                <div class="item"><strong class="d-block">{{ $apartment->houseDetail->bedrooms }}</strong><span>Bedrooms</span></div>
                                <div class="item"><strong class="d-block">{{ $apartment->houseDetail->bathrooms }}</strong><span>Baths</span></div>
                                <div class="item"><strong class="d-block">{{ $apartment->area }}</strong><span>ft<sup>2</sup></span></div>
                            </div>
                            <div class="property-footer d-flex justify-content-between align-items-center">
                                <a href="#" class="user d-flex align-items-center no-anchor-style">
                                    <div class="avatar">
                                        <img src="{{ asset('img/default-user.png') }}" alt="{{$apartment->user->name}}" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <strong class="d-block">{{$apartment->user->name}}</strong>
                                        <span>{{ $apartment->created_at->toFormattedDateString() }}</span>
                                    </div>
                                </a>
                                <a href="/favourite/{{ $apartment->id }}" class="favourite no-anchor-style"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination-->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
