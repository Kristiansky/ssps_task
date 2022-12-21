@include('.includes/header')
<div class="position-absolute w-100">
    <div class="d-flex justify-content-end mt-3">
        <a href="{{url('/')}}" class="btn btn-success btn-sm mb-2">Go to homepage</a>
    </div>
</div>
<h1>Playlist data</h1>
<div class="card card-body bg-light w-100">
    @if(session()->get('data') && count(session()->get('data')) > 0)
        <form method="POST" action="/store-batch" enctype="multipart/form-data">
            @csrf
            @foreach(session()->get('data') as $key => $data_row)
                @php($disabled = '')
                @if($data_row['exists'])
                    @php($disabled = 'disabled')
                @endif
                <div class="form-row mb-2" data-row-id="{{$key}}">
                    @if($disabled !== '')
                        <div class="alert alert-danger w-100">
                            This channel <strong>{{$data_row['tvtitle']}}</strong> is already in the database, do you want to change the values?
                            <div class="btn btn-primary mb-2 mr-2 change-values" data-row-id="{{$key}}">Let me change it</div>
                            <div class="btn btn-secondary mb-2">No</div>
                        </div>
                    @endif
                    <div class="col-1">
                        <img src="{{$data_row['tvlogo']}}" alt="{{$data_row['tvtitle']}}" class="shadow-sm bg-dark rounded w-100 p-2"/>
                        <input type="hidden" value="{{$data_row['tvlogo']}}" name="tvdata[{{$key}}][tvlogo]" {{$disabled}}/>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><small>TV Title</small></span>
                            </div>
                            <input type="text" class="form-control" placeholder="TV Title" value="{{$data_row['tvtitle']}}" name="tvdata[{{$key}}][tvtitle]" {{$disabled}}>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><small>TV Media</small></span>
                            </div>
                            <input type="text" class="form-control" placeholder="TV Media" value="{{$data_row['tvmedia']}}" name="tvdata[{{$key}}][tvmedia]" {{$disabled}}>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><small>TV Id</small></span>
                            </div>
                            <input type="text" class="form-control" placeholder="TV Id" value="{{$data_row['tvid']}}" name="tvdata[{{$key}}][tvid]" {{$disabled}}>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><small>TV Name</small></span>
                            </div>
                            <input type="text" class="form-control" placeholder="TV Name" value="{{$data_row['tvname']}}" name="tvdata[{{$key}}][tvname]" {{$disabled}}>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><small>TV Group</small></span>
                            </div>
                            <input type="text" class="form-control" placeholder="TV Group" value="{{$data_row['tvgroup']}}" name="tvdata[{{$key}}][tvgroup]" {{$disabled}}>
                        </div>
                    </div>
                        <input type="hidden" value="{{\Carbon\Carbon::now()}}" name="tvdata[{{$key}}][updated_at]" {{$disabled}}/>
                        <input type="hidden" value="{{\Carbon\Carbon::now()}}" name="tvdata[{{$key}}][created_at]" {{$disabled}}/>
                </div>
                <hr/>
            @endforeach
            <div class="form-row mb-2">
                <button type="submit" class="btn btn-primary">Submit channels</button>
            </div>
        </form>
    @endif
</div>
<script>
    $('.change-values').on('click', function (){
        let rowId = $(this).attr('data-row-id');
        $('.form-row[data-row-id="'+rowId+'"] input[disabled]').removeAttr('disabled');
    });
</script>
@include('.includes/footer')
