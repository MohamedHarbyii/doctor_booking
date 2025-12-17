<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Resources\PatientResource;
use App\Services\DatabaseServices\UserDB;
use App\Http\Requests\UpdatePatientRequest;
use App\Services\DatabaseServices\PatientDB;
use Illuminate\Routing\Controller;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);

    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = PatientDB::getAll();

        return $this->sendSuccess(PatientResource::collection($patients));
    }

    public function show(Patient $patient)
    {
        $patient->load('user');

        return $this->sendSuccess(new PatientResource($patient), 'patient retreived successfully');
    }

    public function update(UpdatePatientRequest $request)
    {
        $patient = PatientDB::get_current_patient();
        UserDB::update($patient->user, $request->except(''));
        $patient = PatientDB::update($patient, $request->only(''));

        return $this->sendSuccess(new PatientResource($patient));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $patient = PatientDB::get_current_patient();
        PatientDB::delete($patient);
    }
}
