@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">All Regions</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Regions</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default panel-padding">
        <div class="panel-heading">
            Regions List
        </div>
        <div class="panel-body">
            <a href="{{route('regions.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Create New Region</a>
        </div>
        <table class="table table-bordered table-hover" style="width: 100%" id="regions-table">
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
@endsection

@push ('js')
<script>
$(function() {
    $('#regions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('regions.data') !!}',
        columns: [
            { data: 'id', name: 'id', "width": "10%" },
            { data: 'name', name: 'name' },
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
