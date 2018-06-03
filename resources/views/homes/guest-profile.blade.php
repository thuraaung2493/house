@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="customer-login bg-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{$user->showImage($path)}}" class="img-circle" width="100" height="100" alt="User Image">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h3 class="has-line">{{$user->name}}</h3>
                    <br>
                    <p><i class="fa fa-envelope"></i> &nbsp;&nbsp;<a href="mailto:{{$user->email}}">{{ $user->email}}</a></p>
                    <p><i class="fa fa-map-marker"></i>&nbsp;&nbsp; {{$user->profile->address}}</p>
                    <p><i class="fa fa-phone"></i>&nbsp;&nbsp; {{$user->profile->phone_no}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

