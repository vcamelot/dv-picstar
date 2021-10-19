<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Classes\Positions;
use App\Http\Requests\EmployeeCreateOrUpdateRequest as PostRequest;

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

    public function store(PostRequest $request): JsonResponse
    {
        $employee = Employee::create($this->prepareEmployeeColumns($request));

        return $this->SuccessResponse($employee, 'Employee created', 201);
    }

    public function update($id, PostRequest $request): JsonResponse
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return $this->ErrorResponse([], 'Employee not found');
        }

        $employee->update($this->prepareEmployeeColumns($request));
        $employee->save();

        return $this->SuccessResponse($employee, 'Employee updated', 200);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return $this->SuccessResponse([], 'Deleted', 204);
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

    private function prepareEmployeeColumns(Request $request): array
    {
        $columns = [
            'name' => $request['name'],
            'position' => $request['position'],
            'superior_id' => $request['superior_id'],
            'start_date' => $request['start_date']
        ];
        if (isset($request['end_date'])) {
            $columns['end_date'] = $request['end_date'];
        }

        return $columns;

    }
}
