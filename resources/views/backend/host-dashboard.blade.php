@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">Dashboard</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <section class="content-header">
        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$numOfHouses}}</h3>
                        <p>Houses</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <a href="/backend/user/host/host-houses" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$numOfGuestMessage}}</h3>
                        <p>Messages</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <a href="/guest-messages" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection


