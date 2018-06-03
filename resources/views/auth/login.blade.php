@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">User Area</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">User Login</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="customer-login bg-black-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                    @endif

                    @if(session()->has('info'))
                        <div class="alert alert-info">
                            {!! session()->get('info') !!}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="has-line">Login</h2>
                    <h4 class="text-thin">Already our user?</h4>
                    <br>
                    <form action="{{ route('login') }}" method="post" class="login-form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Type your email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>

                            {{-- error msg --}}
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>

                            {{-- error msg --}}
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-gradient">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-thin">Not our registered user yet? <a href="{{ url('register') }}" class="btn btn-gradient">Register Now</a></h4>
                </div>
            </div>
        </div>
    </section>
@endsection
