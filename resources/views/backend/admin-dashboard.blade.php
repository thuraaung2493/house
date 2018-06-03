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
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$numOfHouses}}</h3>
                        <p>Houses</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <a href="/backend/user/admin/houses" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$numOfUsers}}</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/backend/user/admin/users" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$numOfHosts}}</h3>
                        <p>Hosts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="/backend/user/admin/users/host" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$numOfVistor}}</h3>
                        <p>Unique Vistors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/backend/user/admin/users/vistor" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content-body">
        <div class="box panel-padding">
            <h1 class="has-line">Request Host</h1>
            <br>
            <table class="table table-bordered table-hover" style="width: 100%" id="messages-table">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>Host Name</th>
                        <th>Host Email</th>
                        <th>Host Phone</th>
                        <th>Host Message</th>
                        <th>Send Date</th>
                        <th>Confirm</th>
                        <th>Remove</th>
                        <th>Profile</th>
                    </tr>
                </thead>
            </table>
        </div> <!-- end box -->
    </section>
@endsection

@push ('js')
<script>
$(function() {
    $('#messages-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('contact-messages.data') !!}',
        columns: [
            { data: 'user_id', name: 'user_id' },
            { data: 'host_name', name: 'host_name' },
            { data: 'host_email', name: 'host_email' },
            { data: 'host_phone', name: 'host_phone' },
            { data: 'host_message', name: 'host_message' },
            { data: 'created_at', name: 'created_at' },
            { data: 'confirm', name: 'confirm', 'orderable': false},
            { data: 'remove', name: 'remove', 'orderable': false },
            { data: 'profile', name: 'profile', 'orderable': false },
        ]
    });
});
</script>
@endpush

@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to remove this message?");
    }

    function approve() {
        return confirm("Are you sure?");
    }
</script>
@endsection
