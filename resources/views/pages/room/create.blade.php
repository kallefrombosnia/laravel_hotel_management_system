@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5> Create room </h5>     
                </div>
                <div class="card-body">
                    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">

                        @csrf
    
                        @if(Session::get('fail'))
                          <div class="alert alert-danger">
                            {{Session::get('fail')}}
                          </div>
                        @endif  

                        <div class="form-group">
                            <label for="roomName">Room name</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" id="roomName" type="text" >
                            <span id="phone-error" class="form-text text-danger">@error('name'){{ $message }} @enderror</span>	
                        </div>

                        <div class="form-group">
                            <label for="roomPrice">Room price (per day)</label>
                            <input class="form-control @error('price') is-invalid @enderror" name="price" id="roomPrice" type="text" >
                            <span id="phone-error" class="form-text text-danger">@error('price'){{ $message }} @enderror</span>	
                        </div>

                        <div class="form-group">
                            <label for="roomShortDescription">Room short description</label>
                            <input class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="roomShortDescription" type="text" >
                            <span id="phone-error" class="form-text text-danger">@error('short_description'){{ $message }} @enderror</span>	
                        </div>

                        <div class="form-group">
                            <label for="roomName">Room description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" id="roomLongDescription"  rows="3"></textarea>
                            <span id="phone-error" class="form-text text-danger">@error('long_description'){{ $message }} @enderror</span>	
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                              <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" accept="image/x-png,image/gif,image/jpeg">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                            <span id="phone-error" class="form-text text-danger">@error('image'){{ $message }} @enderror</span>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Create room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection