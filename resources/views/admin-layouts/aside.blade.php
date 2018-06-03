<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $user->showImage($path) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        {{-- @include ('admin.search-form') --}}

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ areActiveRoutes(['admin.home', 'host.home']) }}">
                <a href="{{ checkRoute(route('admin.home'), route('host.home')) }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>

            {{-- Houses --}}
            @can ('show-house')
                <li class="treeview {{ areActiveRoutes(['houses.index', 'host-houses.index', 'houses.unpublish', 'host-houses.unpublish', 'houses.publish', 'host-houses.publish', 'houses.featureHouse', 'host-houses.featureHouse', 'admin-houses.edit', 'host-houses.edit', 'admin-houses.create', 'host-houses.create']) }}">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Houses</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        @can ('create-house')
                            <li class="{{ areActiveRoutes(['admin-houses.create', 'host-houses.create']) }}">
                                <a href="{{ checkRoute(route('admin-houses.create'), route('host-houses.create')) }}"><i class="fa fa-plus-circle"></i> <span>Add New House</span></a>
                            </li>
                        @endcan
                        <li class="{{ areActiveRoutes(['houses.index', 'host-houses.index']) }}">
                            <a href="{{ checkRoute(route('houses.index'), route('host-houses.index')) }}">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; All Houses
                                @if (isAdminOrSuperadmin())
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfHouses}}
                                    </span>
                                </span>
                                @endif
                            </a>
                        </li>
                        @can ('show-featuredHouse')
                            <li class="{{ areActiveRoutes(['houses.featureHouse', 'host-houses.featureHouse']) }}">
                                <a href="{{ checkRoute(route('houses.featureHouse'), route('host-houses.featureHouse')) }}">
                                    <i class="fa fa-star"></i>
                                    &nbsp;&nbsp; Featured Houses
                                    @if (isAdminOrSuperadmin())
                                    <span class="pull-right-container">
                                        <span class="label label-warning pull-right">
                                            {{$numOfFeaturedHouses}}
                                        </span>
                                    </span>
                                    @endif
                                </a>
                            </li>
                        @endcan
                        @can ('block-house')
                        <li class="{{ areActiveRoutes(['houses.unpublish', 'host-houses.unpublish']) }}">
                            <a href="{{ checkRoute(route('houses.unpublish'), route('host-houses.unpublish')) }}">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; Unpublished Houses
                                @if (isAdminOrSuperadmin())
                                    <span class="pull-right-container">
                                        <span class="label label-danger pull-right">
                                            {{$numOfUnpublishHouses}}
                                        </span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        @endcan
                        @can ('approve-house')
                        <li class="{{ areActiveRoutes(['houses.publish', 'host-houses.publish']) }}"">
                            <a href="{{ checkRoute(route('houses.publish'), route('host-houses.publish')) }}">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; Published Houses
                                @if (isAdminOrSuperadmin())
                                    <span class="pull-right-container">
                                        <span class="label label-success pull-right">
                                            {{$numOfPublishHouses}}
                                        </span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Regions --}}
            <li class="treeview {{ areActiveRoutes(['regions.index', 'regions.show', 'regions.edit', 'regions.create']) }}">
                <a href="#">
                    <i class="fa fa-map"></i>
                    <span>Regions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                     <li class='{{ isActiveURL("/backend/user/regions/create") }}'>
                        <a href="/backend/user/regions/create"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp; <span>Add New Region</span></a>
                    </li>
                    <li class="{{ isActiveURL('/backend/user/regions') }}">
                        <a href="/backend/user/regions">
                            <i class="fa fa-circle-o"></i>
                            &nbsp;&nbsp; All Regions
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">
                                    {{$numOfRegion}}
                                </span>
                            </span>
                        </a>
                    </li>
                    @foreach ($regions as $region)
                        <li class='{{ isActiveURL("/backend/user/regions/$region->id") }}'>
                            <a href="/backend/user/regions/{{$region->id}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp; {{$region->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

            {{-- Types --}}
            <li class="treeview {{ areActiveRoutes(['types.index', 'types.show', 'types.edit', 'types.create']) }}">
                <a href="#">
                    <i class="glyphicon glyphicon-tags"></i>
                    <span>Types</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class='{{ isActiveURL("/backend/user/types/create") }}'>
                        <a href="/backend/user/types/create"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp; <span>Add New Type</span></a>
                    </li>
                    <li class="{{ isActiveURL('/backend/user/types') }}">
                        <a href="/backend/user/types">
                            <i class="fa fa-circle-o"></i>
                            &nbsp;&nbsp; All House Types
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">
                                    {{$numOfType}}
                                </span>
                            </span>
                        </a>
                    </li>
                    @foreach ($types as $type)
                        <li class='{{ isActiveURL("/backend/user/types/$type->id") }}'>
                            <a href="/backend/user/types/{{$type->id}}"><i class="fa fa-circle-o"></i>&nbsp;&nbsp; {{$type->type_name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

            {{-- Features --}}
            <li class="{{ areActiveRoutes(['features.index', 'features.create']) }}">
                <a href="/backend/user/features">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span>Features</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">
                            {{$numOfFeature}}
                        </span>
                    </span>
                </a>
            </li>

            {{-- Users --}}
            @can ('show-user')
                <li class="treeview {{ areActiveRoutes(['users.index', 'users.host', 'users.vistor', 'users.admin', 'users.superadmin', 'users.edit', 'users.create']) }}">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        @can ('create-user')
                            <li class="{{ isActiveURL('/backend/user/admin/users/create') }}">
                                <a href="/backend/user/admin/users/create"><i class="fa fa-user-plus"></i>&nbsp;&nbsp; <span>Add New User</span></a>
                            </li>
                        @endcan
                        <li class="{{ isActiveURL('/backend/user/admin/users') }}">
                            <a href="/backend/user/admin/users">
                                <i class="fa fa-users"></i>
                                &nbsp;&nbsp; All User
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfUsers}}
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="{{ isActiveURL('/backend/user/admin/users/superadmin') }}">
                            <a href="/backend/user/admin/users/superadmin">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp;Superadmins
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfSuperAdmin}}
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="{{ isActiveURL('/backend/user/admin/users/admin') }}">
                            <a href="/backend/user/admin/users/admin">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; Admins
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfAdmin}}
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="{{ isActiveURL('/backend/user/admin/users/host') }}">
                            <a href="/backend/user/admin/users/host">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; Hosts
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfHost}}
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="{{ isActiveURL('/backend/user/admin/users/vistor') }}">
                            <a href="/backend/user/admin/users/vistor">
                                <i class="fa fa-circle-o"></i>
                                &nbsp;&nbsp; Vistors
                                <span class="pull-right-container">
                                    <span class="label label-primary pull-right">
                                        {{$numOfVistor}}
                                    </span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{-- Roles --}}
            @can ('show-role')
                <li class="{{ areActiveRoutes(['roles.index', 'roles.create']) }}">
                    <a href="/backend/user/admin/roles">
                        <i class="fa fa-magic"></i>
                        <span>Roles</span>
                        @if (isAdminOrSuperadmin())
                        <span class="pull-right-container">
                            <span class="label label-warning pull-right">
                                {{$numOfRole}}
                            </span>
                        </span>
                        @endif
                    </a>
                </li>
            @endcan
        </ul>
        <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->

</aside>
