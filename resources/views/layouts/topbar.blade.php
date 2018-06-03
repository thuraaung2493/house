<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block menu-left">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="/contact-us">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right menu-right">
                <ul class="list-inline">
                    @guest
                        <li class="list-inline-item"><a href="{{ url('register') }}"><i class="fa fa-user-plus"></i>Register</a></li>
                        <li class="list-inline-item"><a href="{{ url('login') }}" class="pr-0 border-right-0""><i class="fa fa-sign-in"></i>Login In</a></li>
                    @else
                    @if ($numOfFavourite > 0)
                        <li class="list-inline-item">
                            <a href="/favourite"><i class="fa fa-heart-o"></i>Favourites</a>
                        </li>
                    @endif
                    @if (isAdminOrSuperadmin() || auth()->user()->type() == 'host')
                        <li class="list-inline-item"><a href="/backend/user/{{isAdminOrSuperadmin() ? 'admin' : 'host'}}">
                            <i class="fa fa-user"></i>{{ Auth::user()->name }}
                                @if (auth()->user()->type() == 'admin' or 'superadmin')
                                    @if ($numOfContactMessage > 0 || $numOfGuestMessage > 0)
                                        &nbsp;&nbsp;&nbsp;
                                        <span class="noti">
                                            {{$numOfContactMessage + $numOfGuestMessage}}
                                        </span>
                                    @endif
                                @elseif (auth()->user()->type() == 'host' && $numOfGuestMessage > 0)
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="noti">
                                        {{$numOfGuestMessage}}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @elseif (auth()->user()->type() == 'guest')
                        <li class="list-inline-item"><a href="/guest/profile">
                            <i class="fa fa-user"></i>{{ Auth::user()->name }}
                        </a></li>
                    @endif
                        <li class="list-inline-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="pr-0 border-right-0""><i class="fa fa-sign-out"></i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>
