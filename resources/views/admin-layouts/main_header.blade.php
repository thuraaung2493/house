<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        @if (auth()->user()->type() == 'superadmin')
            <span class="logo-mini"><small class="s">S</small></span>
        @elseif (auth()->user()->type() == 'admin')
            <span class="logo-mini"><small>Admin</small></span>
        @elseif (auth()->user()->type() == 'host')
            <span class="logo-mini"><small>Host</small></span>
        @endif
        <!-- logo for regular state and mobile devices -->
        @if (auth()->user()->type() == 'superadmin')
            <span class="logo-lg"><b>Super</b>Admin</span>
        @elseif (auth()->user()->type() == 'admin')
            <span class="logo-lg"><b>Admin</b></span>
        @elseif (auth()->user()->type() == 'host')
            <span class="logo-lg"><b>Host</b></span>
        @endif
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    @if ($numOfGuestMessage > 0)
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{$numOfGuestMessage}}</span>
                        </a>
                    @endif
                    <ul class="dropdown-menu">
                        <li class="header">You have {{$numOfGuestMessage}} {{$numOfGuestMessage > 1 ? "messages" : "message"}}</li>
                        <li>
                            <!-- inner menu: contains the messages -->
                            <ul class="menu">
                                @if (!empty($message))
                                <li><!-- start message -->
                                    <a href="{{route('guest-messages.show', $message->id)}}">
                                        <div class="pull-left">
                                            <!-- User Image -->
                                            <img src="{{ asset('/img/default-user.png') }}" class="img-circle" alt="User Image">
                                        </div>
                                        <!-- Message title and timestamp -->
                                        <h4>
                                            {{$message->guest_name}}
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <!-- The message -->
                                        <p>{{str_limit($message->guest_message, 20)}}</p>
                                    </a>
                                </li>
                                @endif
                                <!-- end message -->
                            </ul>
                            <!-- /.menu -->
                        </li>
                        <li class="footer">
                            <a href="{{route('guest-messages.index')}}">See All Messages</a>
                        </li>
                    </ul>
                </li>
                <!-- /.messages-menu -->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ $user->showImage($path) }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ $user->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ $user->showImage($path) }}" class="img-circle" alt="User Image">

                            <p>
                                {{$user->name}}
                                <small>Member since {{$user->created_at->toFormattedDateString()}}</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('profiles.show', $user->id)}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

                {{-- goto front page --}}
                <li>
                    <a href="/"><i class="fa fa-home fa-lg"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
