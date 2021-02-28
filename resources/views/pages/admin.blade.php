@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (Session::get('success') )
                <div class="alert alert-success">
                    <p>{{Session::get('success') }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5>Dashboard
                        <a href="{{route('admin.create')}}">
                            <button class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add room</button>
                        </a>               
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room name</th>
                            <th scope="col">Price €</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room) 
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$room->room_name}}</td>
                                    <td>{{$room->room_price_night}}</td>
                                    <td>
                                        <div class="float-right">
                                            <form action="{{ route('admin.destroy', $room->id) }}" method="POST">
                                                <a href="{{route('admin.show', $room->id)}}">
                                                    <div class="btn btn-primary btn-sm action-button"><i class="fas fa-info-circle"></i> View</div>
                                                </a>
                                                <a href="{{route('admin.edit', $room->id)}}"> 
                                                    <div class="btn btn-warning btn-sm action-button"><i class="fas fa-edit"></i> Edit room</div>
                                                </a> 

                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger btn-sm action-button"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
