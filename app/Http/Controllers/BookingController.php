<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\DatabaseServices\BookingDB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        
    }
    public function index()
    {
        $booking=BookingDB::GetPatientBooking();
        
        return $this->sendSuccess(BookingResource::collection($booking));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $booking = BookingDB::store($request->validated());
        return $this->sendSuccess($booking,'booking created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking=BookingDB::update($booking,$request->validated());
        return $this->sendSuccess(new BookingResource($booking),'booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        BookingDB::delete($booking);
        $this->sendSuccess(null,'booking deleted successfully');
    }
}
