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

        // Validate user input
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'image' => 'required'
        ]);

        // Create a new object instance
        $room = new Room();

        // Assign values
        $room->room_name = $request->name;
        $room->room_price_night = $request->price;
        $room->room_short_description = $request->short_description;
        $room->room_description = $request->long_description;

        // Save to database
        $room->save();

        // Also save an image to the public storage folder
        $request->image->storeAs('public', ($room->id . '.jpg'));


        // Redirect back with flash session 
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

        // Find row in db using room id
        $room = Room::find($id);

        // Return view 
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

        // Find row in db using room id
        $room = Room::find($id);

        // Return view 
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

        // Validate user input
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        // Find row in database
        $room = Room::find($id);

        // Assing new values
        $room->room_name = $request->name;
        $room->room_price_night = $request->price;
        $room->room_short_description = $request->short_description;
        $room->room_description = $request->long_description;

        // Overwrite
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

        // Redirect back with flash success session
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

        // Find room id
        $room = Room::find($room);

        // Delete row
        $room->delete();

        // Redirect back with success flash message
        return redirect()->route('admin.index')
            ->with('success', 'Room deleted successfully');
    }
}
