@extends ('layouts.master')

@section ('content')
     <!-- Property Single Section-->
    <section class="property-single bg-black-2">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/gallery">Gallery</a></li>
                    <li aria-current="page" class="breadcrumb-item active">{{ $house->title }}</li>
                </ol>
            </nav>
            <header>
                <h1 class="h2 d-flex align-items-center">
                    <span class="text-uppercase">{{ $house->title }}</span>
                    @if ($house->user_id == auth()->id())
                        <a href="{{route('houses.edit', $house->id)}}" class="pr-3"><i class="fa fa-edit"></i></a>
                    @endif
                    @if ($house->featured_house == 1)
                        <div class="badge badge-primary">Featured</div>
                    @endif
                    @can ('add-favourite', $house)
                        <a title="Add To Favourite" href="/favourite/{{ $house->id }}" class="fav-button pl-3 black"><i class="fa fa-heart"></i></a>
                    @endcan
                </h1>
                <p class="template-text">{{ $house->location->address }}</p>
            </header>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Image Slider -->
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div style="background: url({{ $image->showImages($path) }}); background-size: cover;" class="swiper-slide"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div style="background: url({{ $image->showImages($path) }}); background-size: cover;" class="swiper-slide"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- Message --}}
                <div class="col-lg-4">
                    <div class="property-single-author bg-black-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <img src="{{ asset('/img/default-user.png') }}" alt="{{ $house->user->name }}" class="img-fluid">
                            </div>
                            <div class="text">
                                <strong>{{ $house->user->name }}</strong>
                                <span class="text-capitalize">
                                    @if ($house->currentUserOwns($house))
                                        (Owner)
                                    @endif
                                    {{$house->user->type()}}
                                </span>
                            </div>
                        </div>
                        <ul class="contact-info list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ $house->user->email }}"><i class="fa fa-envelope"></i>{{ $house->user->email }}</a></li>
                            <li class="list-inline-item"><a href="#"><i class="icon-smart-phone-2"></i>(+95) {{ $house->user->profile->phone_no }}</a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-home"></i>{{ $house->user->profile->address }}</a></li>
                        </ul>
                        <div class="agent-contact">
                            <form method="POST" action="{{route('guest-messages.store', $house->id)}}" class="agent-contact-form">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <input type="hidden" name="host_id" value="{{$house->user_id}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="guest_name" placeholder="Your Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="guest_email" placeholder="Your Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="guest_phone" placeholder="Your Phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea name="guest_message" placeholder="Message" class="form-control radius-small"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-gradient full-width">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Details-->
            <div class="property-single-details bg-black-3 mt-5 block">
                <h3 class="h4 has-line">Property Details</h3>
                <div class="row">
                    <div class="col-lg-3">
                        <strong>Property ID</strong>
                        <span>{{ $house->id }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Type of property</strong>
                        <span>{{ $house->houseType->type_name }}</span>
                    </div>
                    {{-- <div class="col-lg-3"><strong>Property status</strong><span>For sale</span></div> --}}
                    <div class="col-lg-3">
                        <strong>Price</strong>
                        <span>MMK {{ number_format($house->price, 3) }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Land area</strong>
                        <span>{{ $house->area }} sqft</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Bathrooms</strong>
                        <span>{{ $house->houseDetail->bathrooms }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Bedrooms</strong>
                        <span>{{ $house->houseDetail->bedrooms }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Year built</strong>
                        <span>{{ $house->houseDetail->building_year }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Parking</strong>
                        <span>{{ $house->houseDetail->parking ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Water</strong>
                        <span>{{ $house->houseDetail->water ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="col-lg-3">
                        <strong>Exercise Room</strong>
                        <span>{{ $house->houseDetail->exercise_room ? 'Yes' : 'No' }}</span>
                    </div>
                </div>
            </div>

            <!-- Property Description-->
            <div class="property-single-description bg-black-3 mt-5 block">
                <h3 class="h4 has-line">Property Description  </h3>
                <p>{{ $house->description }}</p>
            </div>

            <!-- Property Features-->
            <div class="property-single-features bg-black-3 mt-5 block">
                <h3 class="h4 has-line">Property Features</h3>
                <div class="row">
                    @foreach ($all_features as $all_feature)
                    <div class="col-lg-3">
                        <div class="label-template-checkbox text-white {{ in_array($all_feature->name, $features) ? 'active' : '' }}">{{ $all_feature->name }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Property Map-->
            {{-- <div class="property-single-map bg-black-3 mt-5 block">
                <h3 class="h4 has-line">View on map</h3>
                <div id="property-single-map"></div>
            </div> --}}

            <!-- Property Review-->
            <div class="property-single-write-review bg-black-3 mt-5 block">
                <h3 class="h4 has-line">Review</h3>
                @if (count($reviews) < 1)
                    <p>No Reviews</p>
                @else
                    <ul class="list-group">
                        @foreach ($reviews as $review)
                            <li class="list-group-item bg-black-2 text-white">
                                <strong>
                                    <em>{{ $review->created_at->diffForHumans() }}:</em> &nbsp;
                                </strong>
                                {{ $review->body }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <hr class="line mt-5 mb-5">
                <form action="/houses/{{ $house->id }}/reviews" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <textarea name="body" id="body" class="form-control radius-sm" value="{{ old('body') }}" rows="5" placeholder="Your review here"></textarea>

                            {{-- error msg --}}
                            @if ($errors->has('body'))
                                <div class="text-danger font-italic">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>
                        <div class="w-100"></div>
                        <div class="col-lg-6 mt-3">
                            <button type="submit" class="btn btn-gradient">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Similar Properties Section-->
    <section class="similar-properties bg-black-3">
        <div class="container">
            <header>
                <h2>Similar Properties</h2>
                <p class="template-text">Checkout out some of our listed properties</p>
            </header>
            <div class="swiper-container apartments-slider px-2">
                <div class="swiper-wrapper pt-2 pb-5">
                    @foreach ($related_houses as $related_house)
                        @if ($related_house->location != null)
                            <div class="swiper-slide">
                                <div class="property">
                                    <div class="image">
                                        @foreach ($related_house->galleries as $image)
                                            <img src="{{ $related_house->showFeaturedImage($path) }}" alt="{{ $related_house->featuredImage()->image_name }}" class="img-fluid">
                                        @endforeach
                                        <div class="overlay d-flex align-items-center justify-content-center">
                                            <a href="/houses/{{ $related_house->id }}" class="btn btn-gradient btn-sm">View Details</a>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <a href="houses/{{ $related_house->id }}" class="no-anchor-style">
                                            <h3 class="h4 text-thin text-uppercase mb-1">{{ $related_house->title }}</h3>
                                        </a>
                                        <ul class="tags list-inline">
                                            <li class="list-inline-item">
                                                <a href="#">{{ $related_house->location->township }},</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    {{ $related_house->location->region->name }}
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="price text-primary text-capitalize"><strong class="mr-1">${{ $related_house->price }}</strong><small>/ {{ $related_house->period }}</small></div>
                                    </div>
                                    <div class="statistics d-flex justify-content-between text-center">
                                        <div class="item"><strong class="d-block">{{ $related_house->houseDetail->bedrooms }}</strong><span>Bedrooms</span></div>
                                        <div class="item"><strong class="d-block">{{ $related_house->houseDetail->bathrooms }}</strong><span>Baths</span></div>
                                        <div class="item"><strong class="d-block">{{ $related_house->area }}</strong><span>ft<sup>2</sup></span></div>
                                    </div>
                                    <div class="property-footer d-flex justify-content-between align-items-center">
                                        <a href="#" class="user d-flex align-items-center no-anchor-style">
                                            <div class="avatar">
                                                <img src="{{ asset('img/default-user.png') }}" alt="{{$related_house->user->name}}" class="img-fluid">
                                            </div>
                                            <div class="text">
                                                <strong class="d-block">{{$related_house->user->name}}</strong>
                                                <span>{{ $related_house->created_at->toFormattedDateString() }}</span>
                                            </div>
                                        </a>
                                        <a href="/favourite/{{ $related_house->id }}" class="favourite no-anchor-style"><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Add Pagination-->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

@endsection

@section ('js')

    <script src="{{ asset('/js/swiper-thumbs.js') }}"></script>

@endsection
