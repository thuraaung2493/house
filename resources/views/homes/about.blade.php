@extends ('layouts.master')

@section ('content')
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item {{ isActiveURL('/about') }}">About Us</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Brief Section-->
    <section class="about-brief bg-black-2">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6">
                    <h2 class="h3 text-thin has-line">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
                    <p class="template-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. LOLUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p class="template-text">LOLDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                </div>
                <div class="col-lg-6"><img src="{{asset('img/about-img.jpeg')}}" alt="..." class="img-fluid"></div>
            </div>
        </div>
    </section>
@endsection
