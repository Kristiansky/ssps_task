@include('.includes/header')
<div class="position-absolute w-100">
    <div class="d-flex justify-content-end mt-3">
        <a href="{{url('/')}}" class="btn btn-success btn-sm mb-2">Go to homepage</a>
    </div>
</div>
<h1><img src="{{$channel->tvlogo}}" alt="{{$channel->tvtitle}}" class="shadow-sm bg-dark rounded p-2"/> {{$channel->tvtitle}}</h1>
@include('.includes/footer')
