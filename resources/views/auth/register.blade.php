@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">Register Area</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">User Register</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="customer-login bg-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="has-line">New Account</h2>
                    <h4 class="text-thin">Not our registered user yet?</h4>
                    <br>
                    <form action="{{ route('register') }}" method="post" class="login-form">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" name="name" placeholder="Type your full name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required autofocus>

                            {{-- error msg --}}
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Type your email address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>

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
                            <input type="password" name="password_confirmation" placeholder="Password Confirm" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-gradient">Register</button>
                        </div>
                    </form>
                </div>
            </div>
           {{--  <hr>
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-thin">Register with:</h4>
                    <a href="#" class="btn btn-gradient btn-sm mr-3"><i class="fa fa-facebook"></i> &nbsp;&nbsp;Facebook</a>
                    <a href="#" class="btn btn-gradient btn-sm mr-3"><i class="fa fa-twitter"></i> &nbsp;&nbsp;Twitter</a>
                    <a href="#" class="btn btn-gradient btn-sm"><i class="fa fa-google"></i> &nbsp;&nbsp;Google</a>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

