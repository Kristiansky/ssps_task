@include('.includes/header')
    <div class="position-absolute w-100">
        <div class="d-flex justify-content-end mt-3">
            <a href="{{url('/import')}}" class="btn btn-success btn-sm mb-2">Import</a>
        </div>
    </div>
    <h1>All channels</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    @endif
    @if(count($channels) > 0)
        <div class="mt-3">
            <table class="table table-bordered" id="tickets-list">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>TV logo</th>
                    <th>TV Title</th>
                    <th>TV Media</th>
                    <th>TV Id</th>
                    <th>TV Name</th>
                    <th>TV Group</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($channels as $channel)
                    <tr>
                        <td>{{$channel->id}}</td>
                        <td><img src="{{$channel->tvlogo}}" alt="{{$channel->tvtitle}}" class="shadow-sm bg-dark rounded w-100 p-2"/></td>
                        <td>{{$channel->tvtitle}}</td>
                        <td>{{$channel->tvmedia}}</td>
                        <td>{{$channel->tvid}}</td>
                        <td>{{$channel->tvname}}</td>
                        <td>{{$channel->tvgroup}}</td>
                        <td>
                            <form action="{{ route('channels.destroy',$channel->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                <a class="btn btn-info btn-sm mb-2 mr-2" href="{{ route('channels.show',$channel->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-primary btn-sm mb-2" href="{{ route('channels.edit',$channel->id) }}"><i class="fa fa-pencil"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h3>No data</h3>
    @endif
@include('.includes/footer')
