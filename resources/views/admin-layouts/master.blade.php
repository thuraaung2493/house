<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trippodise-Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('img/Frame.png')}}">

    @include ('admin-layouts.styles')

    @yield ('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        @include ('admin-layouts.main_header')

        @include ('admin-layouts.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield ('page-header')

            <!-- Main content -->
            <section class="content">

                @yield ('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include ('admin-layouts.footer')

        {{-- @include ('admin-layouts.control_sidebar') --}}

    </div>
    <!-- ./wrapper -->

    @include ('admin-layouts.scripts')

    @include('sweet::alert')

    @stack ('js')
    @yield ('js')

</body>
</html>
