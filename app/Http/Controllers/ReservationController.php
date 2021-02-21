<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\DateInPastCheck;

class ReservationController extends Controller
{
    public function createReservation(Request $request){

        var_dump($request->all());

        $request->validate([
            'room' => 'required|exists:rooms,id',
            'email' => 'required|email',
            'phone' => 'required',
            'dateReservation' => ['required', new DateInPastCheck],
            'name' => 'required',

        ]);
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */

    public function messages()
    {
        return [
            'room.exists:rooms,id' => 'Please choose valid room selection.',
        ];
    }
}
