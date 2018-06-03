@extends ('admin-layouts.master')

@section ('content')
    <section class="content">
        <h1 class="has-line mb-3">Create User</h1>
        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{csrf_field()}}

            <div class="form-group">
                <label for="name" class="col-md-2 control-label">User Name:</label>
                <div class="col-md-6 {{$errors->has('name') ? 'has-error' : ''}}">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>

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
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-md-2 control-label">Address:</label>
                <div class="col-md-6">
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="phone_no" class="col-md-2 control-label">Phone Number:</label>
                <div class="col-md-6">
                    <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no') }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('phone_no'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_no') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-2 control-label">Password:</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>

                    {{-- error msg --}}
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="col-md-2 control-label">Password Confirm:</label>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>

                    {{-- error msg --}}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Please select role:</label>
                <div class="col-md-6">
                    @foreach ($roles as $role)
                        <input type="radio" id="role"
                         name="role" value="{{$role->slug}}">
                        <span for="role">&nbsp;{{$role->name}}&nbsp;&nbsp;</span>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="image_name" class="col-md-2 control-label">Profile Picture:</label>
                <div class="col-md-6">
                    <input type="file" name="image" id="image" class="form-control" onchange="previewFile(event);" required>

                    {{-- error msg --}}
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif

                    {{-- Preview --}}
                    <div id="image_preview" class="image-preview border-black-light">
                        <p class="font-2x">No File Choosen</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <button type="submit" class="btn btn-primary mr-3 mt-2">CREATE</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger mt-2">CANCEL</a>
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
