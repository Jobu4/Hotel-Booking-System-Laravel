<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment\Apartment;
use App\Models\Booking\Booking;
use App\Models\Hotel\Hotel;
use Auth;

use DateTime;

class HotelsController extends Controller
{
    //


    public function rooms($id) {
       
        $getRooms = Apartment:: select() ->orderBy('id', 'desc') -> take(6)
        ->where('hotel_id',$id)->get();
        return view('hotels.rooms', compact('getRooms'));
    }

    public function roomDetails($id) {
        $getRoom = Apartment:: find($id);
        return view('hotels.roomdetails', compact('getRoom'));
    }

    public function roomBooking(Request $request,$id) {
        $room =Apartment::find($id);
        $hotel =Hotel::find($id); 
        // the n/j/Y  format removes the zeros on the date formats

if(strval(date("n/j/Y")) < strval($request->check_in) AND strval(date("n/j/Y")) < strval($request->check_out)){
//continue with the logic
if($request->check_in < $request->check_out){
    $datetime1 = new DateTime($request->check_in);
    $datetime2=  new DateTime($request->check_out);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a'); //now you can do whatever you want with the $days
    //continue with the logic
    $bookRooms = Booking::create([
        "name" => $request->name,
        "email" => $request->email,
        "phone_number" => $request->phone_number,
        "check_in" => $request->check_in,
        "check_out" => $request->check_out,
        "days" =>$days,
        "price" => $days * $room->price,
        "user_id" => Auth::user()->id,
        "room_name" => $room->name,
        "hotel_name" => $hotel->name,
    ]);
    
    echo "You booked successfully.";

}else{
    echo "Check out date should be grater than check in date";
}
}else{
    echo "Choose dates in the future, invalid check in or check out date";
    // echo strval(date("n/j/Y"));
    // echo strval($request->check_in);
    // echo strval($request->check_out);
}
    }

}
