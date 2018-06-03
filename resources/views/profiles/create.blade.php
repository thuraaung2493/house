@extends ('layouts.master')

@section ('content')
    <!-- Hero Section-->
    <section class="hero-page bg-black-3">
        <div class="container">
            <h1 class="h2">Profile</h1>
        </div>
    </section>
    <section class="customer-login bg-black-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="has-line">Create Profile</h2>
                    <br>
                    <form action="/profiles" method="post" class="login-form" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="address">Address *</label>
                            <input type="text" id="address" name="address" placeholder="Type your address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" required>

                            {{-- error msg --}}
                            @if ($errors->has('address'))
                                <div class="text-danger font-italic">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone No *</label>
                            <input type="text" id="phone" name="phone_no" placeholder="Type your phone number" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" value="{{ old('phone_no') }}" required>

                            {{-- error msg --}}
                            @if ($errors->has('phone_no'))
                                <div class="text-danger font-italic">
                                    {{ $errors->first('phone_no') }}
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="pl-0 mb-3">Profile Image *</label>
                            <input type="file" name="image" class="form-control radius-sm" onchange="previewFile(event);">

                            {{-- error msg --}}
                            @if ($errors->has('title'))
                                <div class="text-danger font-italic">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            {{-- Preview --}}
                            <div id="image_preview" class="image-preview">
                                <p class="template-text">No File Choosen</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-gradient">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section ('js')
<script>
    function previewFile(event) {
        if($('#feature_image').length) {
            $('#feature_image').remove();
        }
        $('#image_preview > p').text("A profile image choosen");
        $('#image_preview').append("<img height='100px' id='feature_image' src='"+URL.createObjectURL(event.target.files[0])+"'>");
    }
</script>
@endsection

