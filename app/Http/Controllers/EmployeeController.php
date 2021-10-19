<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Classes\Positions;

class EmployeeController extends BaseController
{

    public function index(): JsonResponse
    {
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

    public function children($id): JsonResponse
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return $this->ErrorResponse([], 'Employee not found');
        }
        if ($employee->position !== Positions::MANAGER) {
            return $this->ErrorResponse([], 'Employee is not a manager');
        }

        $associates = Employee::where('superior_id', $id)->get();
        return $this->SuccessResponse(EmployeeResource::collection($associates));

    }

    public function search(Request $request): JsonResponse
    {
        $data = $request->all();
        $position = $data['position'] ?? null;

        if (is_null($position)) {
            return $this->ErrorResponse([], 'Invalid search column');
        }

        $employees = Employee::where('position', $position)->get();
        if (count($employees) == 0) {
            return $this->ErrorResponse([], 'No matching employees found');
        }

        return $this->SuccessResponse($employees);
    }
}
