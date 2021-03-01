<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class DashboardController extends Controller
{

    /**
     * Retrive all rooms in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        // Get all room from db
        $rooms = Room::all();
        
        // Return view with rooms array
        return view('pages.order', ['rooms' => $rooms]);
    }
}
