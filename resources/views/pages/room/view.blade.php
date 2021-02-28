@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex">
                    <form action="{{ route('admin.destroy', $room->id) }}" method="POST">
                        <h5> View - {{$room->room_name}} room
                    
                            
                            <button type="submit" class="btn btn-danger btn-sm action-button float-right "><i class="fas fa-trash"></i> Delete</button>
                            
                            <a href="{{route('admin.edit', $room->id)}}"> 
                                <div class="btn btn-warning btn-sm float-right action-button"><i class="fas fa-edit"></i> Edit room</div>
                            </a>     
                            @csrf
                            @method('delete')  
                                  
                        </h5>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                           <p>
                               Room name: {{$room->room_name}}
                           </p>
                           <p>
                               Room price: {{$room->room_price_night}}€
                           </p>
                           <p>
                               Room description: {{$room->room_description}}
                           </p>
                           <p>
                               Room short description: {{$room->room_short_description}}
                           </p>
                        </div>
                        <div class="col-md-6">
                            <img class="image-preview" src="{{asset('storage/' . $room->id . '.jpg')}}" alt="">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection