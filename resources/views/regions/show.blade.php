@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">{{$region->name}} Region</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Regions</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-home"></i> &nbsp; Houses List in {{$region->name}}
        </div>
        <div class="panel-body panel-padding">
            <table class="table table-bordered table-hover" style="width: 100%" id="houses-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Period</th>
                        <th>Price</th>
                        <th>Area</th>
                        <th>Rooms</th>
                        @if (isAdminOrSuperadmin())
                            <th>Host By</th>
                        @endif
                        <th>Address</th>
                        <th>Region</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push ('js')
<script>
$(function() {
    $('#houses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('region-houses.data', $region->id) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'house_type.type_name', name: 'house_type.type_name' },
            { data: 'period', name: 'period' },
            { data: 'price', name: 'price' },
            { data: 'area', name: 'area' },
            { data: 'rooms', name: 'rooms' },
            @if (isAdminOrSuperadmin())
                { data: 'user.name', name: 'user.name' },
            @endif
            { data: 'location.address', name: 'location.address' },
            { data: 'location.region.name', name: 'location.region.name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', 'orderable': false},
            { data: 'detail', name: 'detail', 'orderable': false },
        ]
    });
});
</script>
@endpush

@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to delete this house?");
    }
</script>
@endsection
