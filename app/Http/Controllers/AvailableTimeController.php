<?php

namespace App\Http\Controllers;

use App\Models\Available_time;
use App\Services\DatabaseServices\AvailableTimeDB;
use App\Http\Requests\Storeavailable_timeRequest;
use App\Http\Requests\Updateavailable_timeRequest;
use App\Traits\MessageTrait;
use Illuminate\Http\JsonResponse;

class AvailableTimeController extends Controller
{
    use MessageTrait;

    public function index(): JsonResponse
    {
        $available_times = AvailableTimeDB::get_time(new Available_time());

        return $this->sendSuccess($available_times, 'Available times retrieved successfully.');
    }

    public function store(Storeavailable_timeRequest $request): JsonResponse
    {
        try {
            $available_time = AvailableTimeDB::add($request->validated());

            return $this->sendSuccess($available_time, 'Available time created successfully.', 201);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function update(Updateavailable_timeRequest $request, Available_time $available_time): JsonResponse
    {
        try {
            $updated_available_time = AvailableTimeDB::update($available_time, $request->validated());

            return $this->sendSuccess($updated_available_time, 'Available time updated successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    public function destroy(Available_time $available_time): JsonResponse
    {
        try {
            AvailableTimeDB::delete($available_time);

            return $this->sendSuccess([], 'Available time deleted successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }
}