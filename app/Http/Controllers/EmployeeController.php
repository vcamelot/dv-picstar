<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends BaseController
{

    public function index(): JsonResponse {
        $employees = Employee::all();
        return $this->SuccessResponse(EmployeeResource::collection($employees));
    }


    public function show($id): JsonResponse
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return $this->ErrorResponse([], 'Employee not found');
        }

        return $this->SuccessResponse(new EmployeeResource($employee));
    }
}
