@extends ('admin-layouts.master')

@section ('page-header')
<section class="content-header">
    <h1 class="has-line">Edit Feature</h1>
    <ol class="breadcrumb">
        <li><a href="/backend/user/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Edit Feature</a></li>
    </ol>
</section>
@endsection

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-edit"></i> &nbsp;Edit Feature
        </div>
        <br>
        <div class="panel-body">
            <form action="{{route('features.update', $feature->id)}}" method="post" class="form-horizontal">
                @method('PATCH')
                {{csrf_field()}}

                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                    <label for="name" class="col-md-2 control-label">Feature Name:</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $feature->name)}}" required>
                    </div>
                    {{-- error msg --}}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            {{$errors->first('name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button class="btn btn-primary mt-3 mr-3">UPDATE</button>
                        <a href="{{route('features.index')}}" class="btn btn-danger mt-3">CANCEL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
