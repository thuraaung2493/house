@extends ('layouts.master')

@section ('content')
    <!-- Slider Section -->
    @include ('homes.home.slider')

    <!-- Search Section-->
    @include ('homes.home.search')

    <!-- New house Section-->
    @include ('homes.home.new-houses')

    <!-- Featured Properties -->
    @include ('homes.home.featured')

    <!-- Apartments Section-->
    @include ('homes.home.apartments')

    <!-- Listings Section -->
    @include ('homes.home.listings')

    <!-- About Section-->
    @include ('homes.home.about')

    <!-- Agents Section-->
    {{-- @include ('homes.home.agents') --}}

    <!-- Testimonials Section-->
    {{-- @include ('homes.home.testimonials') --}}

    <!-- Clients Section -->
    @include ('homes.home.clients')
@endsection


