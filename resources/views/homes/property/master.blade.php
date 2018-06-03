@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="property-grid-sidebar bg-black-3">
        <div class="container">

            @yield ('heading')

            @yield ('breadcrumb')

            @yield ('filter')

            <div class="row">

                <!-- Property Listings-->
                @yield ('listings')

                <div class="col-lg-4">
                    <div class="property-listing-sidebar">

                        @include ('homes.property.search-widget')

                        @include ('homes.property.featured-widget')

                        @include ('homes.property.location-widget')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
