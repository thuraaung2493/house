@extends ('admin-layouts.master')

@section ('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-envelope-o"></i>
            &nbsp;&nbsp;
            Message
        </div>
        <div class="panel-body panel-padding">
            <div class="row">
                <div class="col-md-12">
                    From : {{$guest_message->guest_name}},
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <p>{{$guest_message->guest_message}}</p>
                    <p>I want to rent
                        <em>
                            @if (auth()->user()->type() == 'superadmin' or 'admin')
                                <a href="{{checkRoute(route('admin-houses.show', $guest_message->house_id), route('host-houses.show', $guest_message->house_id))}}">this house</a>
                            @else
                                <a href="{{route('houses.show', $guest_message->house_id)}}">this house</a>
                            @endif
                        </em>.
                    </p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div><i class="fa fa-envelope"></i> &nbsp;&nbsp; <a href="mailto:{{$guest_message->guest_email}}">{{$guest_message->guest_email}},</a></div>
                    <div><i class="fa fa-phone"></i> &nbsp;&nbsp; {{$guest_message->guest_phone}}</div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('guest-messages.destroy', $guest_message->id)}}" method="post" class="d-inline-block" onsubmit="return remove()">
                            @method('DELETE')
                            {{csrf_field()}}

                        <button class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{url()->previous()}}" class="btn btn-primary ml-3">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection


@section ('js')
<script>
    function remove() {
        return confirm("Do you to want to delete this message?");
    }
</script>
@endsection
