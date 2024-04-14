<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Pagging;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name','ASC')->get();
        return view('employee.add_employee', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddEmployeeRequest $request)
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
        
        $employeeId = $request->id;
        $check_employee = Employee::check_employee($data, $employeeId);
        
        if (!empty($check_employee)) {
            $notification = array(
                'message' => 'Employee Already Exist',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
        } else {
            Employee::create($data);
            $notification = array(
                'message' => 'Employee Inserted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        {
            $aColumns = array('employee.id', 'employee.company_id','company.name as company_name','employee.first_name','employee.last_name','employee.email','employee.phone','employee.status', 'employee.created_at');
            $isWhere = array("employee.status != '2'");
            $table = "employees as employee";
            $isJOIN = array(
                'inner join companies as company on company.id = employee.company_id',
            );
            $hOrder = "employee.id desc";
            $sqlReturn = Pagging::get_datatables($aColumns, $table, $hOrder, $isJOIN, $isWhere, $request);
            $appData = array();
            $no = $request->iDisplayStart + 1;
            foreach ($sqlReturn['data'] as $row) {
               
                $row_data = array();
                $row_data[] = $no;
                $row_data[] = $row->company_name;
                $row_data[] = $row->first_name . ' ' . $row->last_name;
                $row_data[] = $row->email;
                $row_data[] = $row->phone;
                $row_data[] = '<a class="btn btn-primary btn-sm px-2" href="' . url('employees/'. $row->id.'/edit') . '" >
                        Edit
                    </a> 
                    <form action="' . route('employees.destroy', $row->id) . '" method="POST" style="display: inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger px-2 btn-sm">Delete</button>
                </form>';
                    
                $appData[] = $row_data;
                $no++;
            }
            $totalrecord = Pagging::count_all($aColumns, $table, $hOrder, $isJOIN, $isWhere, '');
            $numrecord = $sqlReturn['data'];
            $output = array(
                "sEcho" => intval($request->sEcho),
                "iTotalRecords" =>  $numrecord,
                "iTotalDisplayRecords" => $totalrecord,
                "aaData" => $appData
            );
            echo json_encode($output);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = Company::orderBy('name','ASC')->get();
        $employeeData = Employee::with('Company')->where('id', $id)->first();
        return view('employee.edit_employee',compact('employeeData','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $data = array(
            'company_id' => $request->company_id,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'status'     => '1',
            'updated_at' => now(),
        );
      
        $check_employee = Employee::check_employee($data, $id);
        if (!empty($check_employee)) {
            $notification = array(
                'message' => 'Employee Already Exist',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
        } elseif(!empty($id)){
              Employee::where('id', $id)->update($data);
            $notification = array(
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = array(
            "status" => '2'
        );
    
        $deleted = Employee::where('id', $id)->update($data);
    
        if ($deleted) {
            $notification = array(
                'message' => 'Employee Deleted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
        
    }
}
