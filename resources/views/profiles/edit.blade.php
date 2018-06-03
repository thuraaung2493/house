@extends ('admin-layouts.master')

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><i class="fa fa-edit"></i> Edit {{$user->name}}'s Profile</h3>
        </div>
        <div class="panel-body">
            <form action="{{route('profiles.update', $profile->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @method('PATCH')
                {{csrf_field()}}

                <div class="form-group">
                    <label for="address" class="col-md-2 control-label">Address:</label>
                    <div class="col-md-6">
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $profile->address) }}" required>

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
                        <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no', $profile->phone_no) }}" required>

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
                    <label for="image_name" class="col-md-2 control-label">Profile Picture:</label>
                    <div class="col-md-6">
                        <input type="file" name="image" id="image" class="form-control" onchange="previewFile(event);">

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
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <a href="{{route('profiles.show', $profile->user_id)}}" class="btn  btn-danger">CANCEL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
