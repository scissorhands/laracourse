@extends('templates.layout')
@section('content')
<form action="{{ route('users.update', ['user'=>$user->id]) }}"
    method="POST" enctype="multipart/form-data" class="form form-horizontal">
@csrf
@method('PUT')
    <div class="row">
        <div class='col-4'>
            <img src="" alt="img" class="img-thumbnail avatar">
            <div class="card mt-4">
                <div class="card-body">
                    <h6>Upload a different photo</h6>
                    <input type="file" class="form-control-file" name="avatar">
                </div>
            </div>
        </div>
        <div class='col-8'>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</form>
@endsection
