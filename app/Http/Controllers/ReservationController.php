<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function createReservation(Request $request){

        var_dump($request->all());

        $request->validate([
            'room' => 'required|exists:rooms,id',
            'email' => 'required',
            'phone' => 'required',
            'dateReservation' => 'required',
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
            'room.exists' => 'Please choose valid room selection.',
        ];
    }
}
