@extends ('admin-layouts.master')

@section ('content')
    <section class="content">
        <h1 class="has-line mb-3">Edit User</h1>
        <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @method('PATCH')
        {{csrf_field()}}

            <div class="form-group">
                <label for="name" class="col-md-2 control-label">User Name:</label>
                <div class="col-md-6 {{$errors->has('name') ? 'has-error' : ''}}">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-2 control-label">Email:</label>
                <div class="col-md-6 {{$errors->has('name') ? 'has-error' : ''}}">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="old_password" class="col-md-2 control-label">Old Password:</label>
                <div class="col-md-6">
                    <input type="password" name="old_password" id="old_password" class="form-control" value="{{ old('old_password') }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('old_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="new_password" class="col-md-2 control-label">New Password:</label>
                <div class="col-md-6">
                    <input type="password" name="new_password" id="new_password" class="form-control" value="{{ old('new_password') }}">

                    {{-- error msg --}}
                    @if ($errors->has('new_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            @can ('update-role')
            <div class="form-group">
                <label class="col-md-2 control-label">Please select role:</label>
                <div class="col-md-6">
                    @foreach ($roles as $role)
                        <input type="radio" id="{{$role->slug}}role"
                         name="role" value="{{$role->slug}}" {{$userRole->slug == $role->slug ? 'checked' : ''}}>
                        <span for="{{$role->slug}}role">&nbsp;{{$role->name}}&nbsp;&nbsp;</span>
                    @endforeach
                </div>
            </div>
            @endcan
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <button type="submit" class="btn btn-primary mr-3 mt-3">Update</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger mt-3">CANCEL</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@section ('js')
<script>
    function previewFile(event) {
        if($('#feature_image').length) {
            $('#feature_image').remove();
        }
        $('#image_preview > p').text("A feature image choosen");
        $('#image_preview').append("<img height='100px' id='feature_image' src='"+URL.createObjectURL(event.target.files[0])+"'>");
    }
</script>
@endsection
