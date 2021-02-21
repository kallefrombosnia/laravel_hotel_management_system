<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index(Request $request){

        $rooms = Room::all();

        return view('pages.order', ['rooms' => $rooms]);
    }
}
