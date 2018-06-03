@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">All Users</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Users</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-users"></i> &nbsp;All Users List
        </div>
        <br>
        @can ('create-user')
            <div class="panel-body panel-padding">
                <a href="{{route('users.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Creat New User</a>
            </div>
        @endcan
        <div class="panel-padding">
            <table class="table table-bordered table-hover" style="width: 100%" id="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        @can ('update-user')
                            <th>Edit</th>
                        @endcan
                        @can ('delete-user')
                            <th>Delete</th>
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
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'roles[0].name', name: 'roles[0].name', 'orderable': false, 'searchable': false },
            { data: 'created_at', name: 'created_at', "width": "10%" },
            @can ('update-user')
                { data: 'edit', name: 'edit', 'orderable': false},
            @endcan
            @can ('delete-user')
                { data: 'delete', name: 'delete', 'orderable': false },
            @endcan
            { data: 'details', name: 'details', 'orderable': false},
        ]
    });
});
</script>
@endpush

@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to delete this user?");
    }
</script>
@endsection
