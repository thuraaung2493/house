@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">Our Gallery</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Gallery</li>
                </ol>
            </nav>
        </div>
    </section>
    <image-component></image-component>
@endsection



