<?php

namespace App\Http\Controllers;

use App\Classes\Positions;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse;

class EmployeeAssociateController extends BaseController
{
    public function index($id): JsonResponse
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
}
