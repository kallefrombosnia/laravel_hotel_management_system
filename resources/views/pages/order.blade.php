@extends('layouts.default')

@section('title', 'Dashboard - Hotel Menagment') 

@section('content')
    <div class="container">
        <div class="form-card">
            <div class="welcome-message text-center">
                Reserve now, enjoy later.
            </div>
            <form action="{{route('reservation')}}" method="post">

              @csrf

              @if(Session::get('fail'))
                <div class="alert alert-danger">
                  {{Session::get('fail')}}
                </div>
              @endif

              <div id="discount-message" class="alert alert-primary" style="display: none" role="alert">
                <span></span>
              </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="roomSelect">Room name *</label>
                        <select name="room" id="roomSelect" class="form-control @error('room') is-invalid @enderror" required>
                          <option value="default" date-price="0">Choose...</option>
                            @foreach ($rooms as $room)
                                <option data-price={{$room->room_price_night}} value="{{$room->id}}">{{$room->room_name}}</option>
                            @endforeach
                        </select>
                        <span id="room-error" class="form-text text-danger">@error('room'){{ $message }} @enderror</span>	
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Reservation *</label>
                        <input name="dateReservation" id="chooseDate" class="form-control" placeholder="Choose">
                        <span class="form-text text-danger">@error('dateReservation'){{ $message }} @enderror</span>	
                    </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="nameInput">Your name and lastname *</label>
                      <input name="name" id="inputName" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" min="3" value="{{old('name')}}">
                      <span id="name-error" class="form-text text-danger">@error('name'){{ $message }} @enderror</span>	
                  </div>
                  <div class="form-group col-md-4">
                      <label for="inputEmail">Email *</label>
                      <input name="email" id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
                      <span id="email-error" class="form-text text-danger">@error('email'){{ $message }} @enderror</span>	
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputPhone">Phone number *</label>
                    <input name="phone" id="inputPhone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number" value="{{old('phone')}}">
                    <span id="phone-error" class="form-text text-danger">@error('phone'){{ $message }} @enderror</span>	
                </div>
              </div>


              <div class="form-group">
                <label for="inputNote">Note message</label>
                <textarea name="notes" class="form-control" id="inputNote" rows="3" value="{{old('notes')}}"></textarea>
              </div>


                <div class="form-group">
                  <label for="inputPrice">Price $</label>
                  <input id="outputPrice" class="form-control" disabled value="0">
                </div>

                <div class="form-group">
                  <small id="emailHelp" class="form-text text-muted">Areas with * are required.</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>


@endsection
    

