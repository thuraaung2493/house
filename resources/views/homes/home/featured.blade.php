<!-- Featured Properties -->
@if (!is_null($featured_house))
<section class="featured-properties pt-0 bg-black-3" id="featured">
    <div class="container">
        <header>
            <h2>Featured <span class="text-primary">Properties</span></h2>
            <div class="row">
                <div class="col-lg-8">
                    <p class="template-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit ab illum, quae aliquid error recusandae corrupti, non vero officiis eaque reiciendis sit cupiditate ipsum.
                    </p>
                </div>
            </div>
        </header>
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 pr-lg-0">
                <div class="image">
                    <img src="{{ $featured_house->showFeaturedImage($path) }}" alt="{{$featured_house->featuredImage()->image_name}}" class="img-fluid" style="min-width: 100%; min-height: 100%">
                </div>
            </div>
            <div class="col-lg-6 pl-lg-0">
                <div class="text"><strong>Featured Properties</strong>
                    <h3 class="text-transform text-thin text-uppercase has-line">{{ $featured_house->title }}</h3>
                    <span class="template-text">
                        {{ $featured_house->location->address }}
                    </span>
                    <p>
                        {{ $featured_house->description }}
                    </p>
                    <div class="price text-uppercase">
                        <strong>${{ $featured_house->price }}</strong><small>/ {{ $featured_house->period }}</small>
                    </div>
                    <a href="houses/{{$featured_house->id}}" class="btn btn-gradient">Read More</a>
                </div>
            </div> <!-- end col-lg-6 -->
        </div> <!-- end row -->
    </div>
</section>
@endif
