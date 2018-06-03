@extends ('admin-layouts.master')

@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="fa fa-envelope-o"></i> &nbsp;Messages from guest
                <a href="{{ checkRoute(route('admin.home'), route('host.home')) }}" class="btn btn-primary pull-right">Back To Dashboard</a>
            </h4>
        </div>
        <div class="panel-body panel-padding">
            <div class="row">
                @if ($messages->isEmpty())
                    <p class="panel-padding">No message!</p>
                @endif
                @foreach ($messages as $message)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <a href="{{route('guest-messages.show', $message->id)}}">
                            <div class="info-box box-shadow">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                                <div class="info-box-content t-black">
                                    <span class="info-box-text">Message From</span>
                                    <span class="info-box-number">{{$message->guest_name}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                    <!-- /.info-box -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
