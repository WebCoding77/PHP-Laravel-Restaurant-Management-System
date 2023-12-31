<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Review;

use Auth;

class UsersController extends Controller
{
    

    public function getBookings() {


        $allBookings = Booking::where('user_id', Auth::user()->id)->get();

        return view('users.bookings', compact('allBookings'));
    }

    public function getOrders() {


        $allOrders = Checkout::where('user_id', Auth::user()->id)->get();

        return view('users.orders', compact('allOrders'));
    }


    public function viewReview() {


        

        return view('users.writereview');
    }

    
    public function submitReview(Request $request) {


        Request()->validate([

            "name" => "required|max:40",
            "review" => "required",
            
        ]);

        $submitReview = Review::create([
            "review" => $request->review,
            "name" => $request->name,
           
        ]);

        if( $submitReview) {

            return redirect()->route('users.review.create')->with(['success' => 'review submitted successfully']);

        }
        

    }

    

    
}
