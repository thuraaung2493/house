@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">All Roles</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Roles</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-users"></i> Role List
        </div>
        <div class="panel-body panel-padding">
            @can ('create-role')
                <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Creat New Role</a>
            @endcan
        </div>
        <div class="panel-padding">
            <table class="table table-bordered table-hover" style="width: 100%" id="houses-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Permissions</th>
                        <th>Created At</th>
                        @can ('update-role')
                            <th>Edit</th>
                        @endcan
                        @can ('delete-role')
                            <th>Delete</th>
                        @endcan
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
        ajax: '{!! route('roles.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'slug', name: 'slug' },
            { data: 'permissions', name: 'permissions' },
            { data: 'created_at', name: 'created_at', "width": "10%" },
            @can ('update-role')
                { data: 'edit', name: 'edit', 'orderable': false},
            @endcan
            @can ('delete-role')
                { data: 'delete', name: 'delete', 'orderable': false },
            @endcan
        ]
    });
});
</script>
@endpush

@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to delete this role?");
    }
</script>
@endsection
