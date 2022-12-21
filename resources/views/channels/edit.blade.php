@include('.includes/header')
<div class="position-absolute w-100">
    <div class="d-flex justify-content-end mt-3">
        <a href="{{url('/')}}" class="btn btn-success btn-sm mb-2">Go to homepage</a>
    </div>
</div>
<h1>Edit <img src="{{$channel->tvlogo}}" alt="{{$channel->tvtitle}}" class="shadow-sm bg-dark rounded p-2"/> {{$channel->tvtitle}}</h1>
<div class="card card-body bg-light w-75">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('channels.update',$channel->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tvtitle">tvtitle</label>
            <input type="text" class="form-control" id="tvtitle" name="tvtitle" value="{{$channel->tvtitle}}">
        </div>
        <div class="form-group">
            <label for="tvmedia">tvmedia</label>
            <input type="text" class="form-control" id="tvmedia" name="tvmedia" value="{{$channel->tvmedia}}">
        </div>
        <div class="form-group">
            <label for="tvid">tvid</label>
            <input type="text" class="form-control" id="tvid" name="tvid" value="{{$channel->tvid}}">
        </div>
        <div class="form-group">
            <label for="tvname">tvname</label>
            <input type="text" class="form-control" id="tvname" name="tvname" value="{{$channel->tvname}}">
        </div>
        <div class="form-group">
            <label for="tvgroup">tvgroup</label>
            <input type="text" class="form-control" id="tvgroup" name="tvgroup" value="{{$channel->tvgroup}}">
        </div>
        <div class="form-group">
            <label for="tvlogo">tvlogo</label>
            <input type="text" class="form-control" id="tvlogo" name="tvlogo" value="{{$channel->tvlogo}}">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>
@include('.includes/footer')
