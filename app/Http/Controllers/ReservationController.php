<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Rules\DateInPastCheck;
use App\Rules\DateArrivalLeaveCheck;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Reservation;
use App\Mail\SendCustomerConfirmationMail;
use App\Mail\SendHotelOrderNoticeMail;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;
use GoogleReCaptchaV3;

class ReservationController extends Controller
{
    public function createReservation(Request $request){

        dd(GoogleReCaptchaV3::verifyResponse(
            $request->input('g-recaptcha-response'),
            $request->getClientIp()
            )
         ->getMessage());

        $request->validate([
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('order')],
            'room' => 'required|exists:rooms,id',
            'email' => 'required|email',
            'phone' => 'required|max:128',
            'dateReservation' => ['required', new DateInPastCheck, new DateArrivalLeaveCheck],
            'name' => 'required|string|min:3|max:150',
        ]);


        // Get night propert and split values
        $nightsRange = explode('-', $request->dateReservation);

        // Dates 
        $arrival = Carbon::createFromFormat('m/d/Y', str_replace(' ', '' , $nightsRange[0]));
        $leave = Carbon::createFromFormat('m/d/Y', str_replace(' ', '' , $nightsRange[1]));

        // Find difference in days 
        $days = $arrival->diffInDays($leave);

        // Get room price from db
        $priceOfRoom = Room::where('id', '=', $request->room)->first();

        // Set discount variable
        $discount = 0;
        $newPrice = 0;


        // Hard coded discounts
        if($days >= 10){

           $discount = 15;
           $newPrice = $this->discount($priceOfRoom->room_price_night, 15);

        }else if($days >= 7 ){

            $discount = 10;
            $newPrice = $this-> discount($priceOfRoom->room_price_night, 10);

        }else if($days >= 5 ){

            $discount = 7;
            $newPrice = $this->discount($priceOfRoom->room_price_night, 7);
            
        }else if($days >= 3 ){

            $discount = 5;
            $newPrice = $this->discount($priceOfRoom->room_price_night, 5);

        }

        // Calculate price for all nights
        $priceForAllNights = 0;

        // Check if discount exists
        if($discount > 0){
            $priceForAllNights = $newPrice * $days;
        }else{
            $priceForAllNights = $priceOfRoom->room_price_night * $days;
        }

        // Order details - customer
        $orderCustomer = [
            'arrival_date' => $nightsRange[0],
            'leave_date' => $nightsRange[1],
            'room_name' => $priceOfRoom->room_name,
            'customer_name' => $request->name,
            'total_days' => $days,
            'total_price' => $priceForAllNights,
            'discount' => $discount,
            'reservation_date' => Carbon::now()
        ];

        // Send mail to customer
        Mail::to($request->email)->send(new SendCustomerConfirmationMail($orderCustomer));


        // Order details - admin
        $orderAdmin = [
            'arrival_date' => $nightsRange[0],
            'leave_date' => $nightsRange[1],
            'room_name' => $priceOfRoom->room_name,
            'customer_name' => $request->name,
            'total_days' => $days,
            'total_price' => $priceForAllNights,
            'discount' => $discount,
            'note' => $request->notes,
            'reservation_date' => Carbon::now()
        ];

        // Send mail to admin
        Mail::to(env("ADMIN_MAIL", "kallegowild@gmail.com"))->send(new SendHotelOrderNoticeMail($orderAdmin));

        // Save user reservation information
        $reservation = new Reservation;

        $reservation->room_id = $request->room;
        $reservation->client_name = $request->name;
        $reservation->client_email = $request->email;
        $reservation->client_phone = $request->phone;
        $reservation->client_note = $request->notes;
        $reservation->arrival_date = $nightsRange[0];
        $reservation->discount = $discount;
        $reservation->leave_date = $nightsRange[1];
        $reservation->registration_date = Carbon::now();
    
        $reservation->save();

        return redirect()->back()->with('success', 'You ordered our services, check your email for confirmation.');

    }

    private function discount($price, $discount){

        $price = (int)$price;
        $discount = (int)$discount / 100;
    
        return $price - ($price * $discount);
    }


}
