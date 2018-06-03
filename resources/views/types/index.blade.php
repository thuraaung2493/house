@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">House Types</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">House Types</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-tags"></i> &nbsp; House Types List
        </div>
        <div class="panel-body panel-padding">
            <a href="{{route('types.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Create New Type</a>
        </div>
        <div class="panel-padding">
            <table class="table table-bordered table-hover" style="width: 100%" id="types-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push ('js')
<script>
$(function() {
    $('#types-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('types.data') !!}',
        columns: [
            { data: 'id', name: 'id', "width": "10%" },
            { data: 'type_name', name: 'type_name' },
            { data: 'created_at', name: 'created_at', "width": "20%" },
            { data: 'edit', name: 'edit', 'orderable': false, "width": "10%"},
            { data: 'delete', name: 'delete', 'orderable': false, "width": "10%" },
        ]
    });
});
</script>
@endpush

@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to delete this region?");
    }
</script>
@endsection
