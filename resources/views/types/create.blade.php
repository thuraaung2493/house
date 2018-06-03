@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">Create House Type</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Create House Type</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-edit"></i> &nbsp;Create House Type
        </div>
        <br>
        <div class="panel-body">
            <form action="{{route('types.store')}}" method="post" class="form-horizontal">
                {{csrf_field()}}

                <div class="form-group {{$errors->has('type_name') ? 'has-error' : ''}}">
                    <label for="type_name" class="col-md-2 control-label">House Type Name:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="type_name" id="type_name" placeholder="Apartments" value="{{old('type_name')}}" required>
                    </div>
                    {{-- error msg --}}
                    @if ($errors->has('type_name'))
                        <span class="help-block">
                            {{$errors->first('type_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button class="btn btn-primary mt-3 mr-3">CREATE</button>
                        <a href="{{route('types.index')}}" class="btn btn-danger mt-3">CANCEL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
