@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">Featured Houses</h1>
    <ol class="breadcrumb">
        <li><a href="{{ checkRoute(route('admin.home'), route('host.home')) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Featured Houses</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-home"></i> &nbsp;Featured Houses List
        </div>
        <div class="panel-body panel-padding">
            <table class="table table-bordered table-hover" style="width: 100%" id="houses-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Area</th>
                        <th>Rooms</th>
                        <th>Host By</th>
                        <th>Address</th>
                        <th>Created At</th>
                        @can ('unfeature-house')
                            <th>Unfeatured</th>
                        @endcan
                        @can ('update-house')
                            @can ('delete-house')
                                <th>Action</th>
                            @endcan
                        @endcan
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
        @can ('show-featuredHouse')
            @if (isAdminOrSuperAdmin())
                ajax: '{!! route('houses.featureData') !!}',
            @else
                ajax: '{!! route('host-houses.featureData') !!}',
            @endif
        @endcan
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'house_type.type_name', name: 'house_type.type_name' },
            { data: 'price', name: 'price' },
            { data: 'area', name: 'area' },
            { data: 'rooms', name: 'rooms' },
            { data: 'user.name', name: 'users.name' },
            { data: 'location.address', name: 'location.address' },
            { data: 'created_at', name: 'created_at' },
            @can ('unfeature-house')
                { data: 'unfeature', name: 'unfeature', 'orderable': false},
            @endcan
            @can ('update-house')
                @can ('delete-house')
                    { data: 'action', name: 'action', 'orderable': false},
                @endcan
            @endcan
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
