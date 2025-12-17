<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DatabaseServices\DoctorDB;
use App\Services\DatabaseServices\UserDB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class DoctorController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor = DoctorDB::all_doctors();

        return $this->sendSuccess(DoctorResource::collection($doctor));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        
        $doctor = DoctorDB::add_doctor($request->validated());

        return $this->sendSuccess(new DoctorResource($doctor));
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return $this->sendSuccess(new DoctorResource($doctor));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $this->authorize('update',$doctor);
        $doctor = DoctorDB::update_doctor($doctor, $request->validated());

        return $this->sendSuccess(new DoctorResource($doctor));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $this->authorize('delete',$doctor);
        DoctorDB::delete_doctor($doctor);

        return $this->sendSuccess(null,'doctor deleted successfully');
    }
}
