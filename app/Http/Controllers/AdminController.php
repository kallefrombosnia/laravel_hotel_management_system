<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Room;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $rooms = Room::all();
        return view('pages.admin', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'image' => 'required'
        ]);

        $room = new Room();

        $room->room_name = $request->name;
        $room->room_price_night = $request->price;
        $room->room_short_description = $request->short_description;
        $room->room_description = $request->long_description;

        $room->save();

        $request->image->storeAs('public', ($room->id . '.jpg'));

        return redirect()->route('admin.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        return view('pages.room.view', ['room' => $room]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $room = Room::find($id);

        return view('pages.room.edit', ['room' => $room]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);


        $room = Room::find($id);

        $room->room_name = $request->name;
        $room->room_price_night = $request->price;
        $room->room_short_description = $request->short_description;
        $room->room_description = $request->long_description;

        $room->save();
        

        // Check if new picture is present in request
        if ($request->has('image')) {
            // Check if picture exists in storage
            if (Storage::disk('public')->exists($id . '.jpg')){
                // Delete old picture
                Storage::disk('public')->delete($id . '.jpg');
                // Save new picture
                $request->image->storeAs('public', $id . '.jpg');
            }
        }


        return redirect()->route('admin.index')
            ->with('success', 'Room "'. $request->name .'" was updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($room)
    {
        $room = Room::find($room);

        $room->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Room deleted successfully');
    }
}
