<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    public function getEmployeesByCompany($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json([
                'status' => false,
                'message' => 'Company not found'
            ], 404);
        }

        $employees = $company->employees; 

        return response()->json([
            'status' => true,
            'message' => 'Employees found successfully', 
            'data' => $employees
        ], 200);
    }

    public function employeeAdd(AddEmployeeRequest $request)
    {
        $data = array(
            'company_id' => $request->company_id,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'status'     => '1',
            'created_at' => now(),
            'updated_at' => now(),
        );

        $existingEmployee = Employee::where('email', $request->email)->first();

        if ($existingEmployee) {
            return response()->json([
                'status' => false, 
                'message' => 'Employee Already Exists'
            ], 400);
        }
       $employee = Employee::create($data);

        return response()->json([
            'status' => true, 
            'message' => 'Employee Inserted Successfully',
            'data' => $employee,
        ], 200);
    }
}
