@include('.includes/header')
<div class="position-absolute w-100">
    <div class="d-flex justify-content-end mt-3">
        <a href="{{url('/')}}" class="btn btn-success btn-sm mb-2">Go to homepage</a>
    </div>
</div>
<h1>Import channels</h1>
<div class="card card-body bg-light w-50">
    <form method="POST" action="/store" enctype="multipart/form-data">
        @csrf
        @error('import_file')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="import_file">
            <small id="exampleFormControlFile1Help" class="form-text text-muted">Allowed file extensions: m3u</small>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Import file</button>
    </form>
</div>
@include('.includes/footer')
