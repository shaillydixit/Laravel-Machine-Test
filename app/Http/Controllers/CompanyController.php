<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Pagging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.add_company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCompanyRequest $request)
    {
        $data = array(
            'name'       => $request->name,
            'email'      => $request->email,
            'website'    => $request->website,
            'status'     => '1',
            'created_at' => now(),
            'updated_at' => now(),
        );
        
        $companyId = $request->id;
        $check_company = Company::check_company($data, $companyId);
        
        if (!empty($check_company)) {
            $notification = array(
                'message' => 'Company Already Exist',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
        } else {
            if ($request->hasFile('logo')) {
                $filename = 'logo_' . time() . '.' . $request->logo->extension();
                $request->logo->storeAs('files/company', $filename, 'public');
                $data['logo'] = $filename;
            }
        
            Company::create($data);
            $notification = array(
                'message' => 'Company Inserted Successfully',
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
            $aColumns = array('company.id', 'company.name','company.email','company.website','company.logo','company.status', 'company.created_at');
            $isWhere = array("company.status != '2'");
            $table = "companies as company";
            $isJOIN = array();
            $hOrder = "company.id desc";
            $sqlReturn = Pagging::get_datatables($aColumns, $table, $hOrder, $isJOIN, $isWhere, $request);
            $appData = array();
            $no = $request->iDisplayStart + 1;
            foreach ($sqlReturn['data'] as $row) {
               
                $row_data = array();
                $row_data[] = $no;
                $row_data[] =(!empty($row->logo)) ? '<img src="' . URL::to('/') . '/storage/files/company' . '/' . $row->logo . '" width="50" height="50" class="img-thumbnail rounded-circle">' : '';
                $row_data[] = $row->name;
                $row_data[] = $row->email;
                $row_data[] = $row->website;
                $row_data[] = '<a class="btn btn-primary btn-sm px-2" href="' . url('companies/'. $row->id.'/edit') . '" >
                        Edit
                    </a> 
                    <form action="' . route('companies.destroy', $row->id) . '" method="POST" style="display: inline;">
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
        $companyData = Company::where('id', $id)->first();
        return view('company.edit_company',compact('companyData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $data = array(
			'name'	 	 => $request->name,
			'email'	     => $request->email,
            'website'	 => $request->website,
            'status'     => '1',
            'updated_at' => now(),
		);
      
		$check_company	= Company::check_company($data, $id);
        if (!empty($check_company)) {
            $notification = array(
                'message' => 'Company Already Exist',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
		} elseif(!empty($id)){
            if ($request->hasFile('logo')) {
                $filename = 'logo_' . time() . '.' . $request->logo->extension();
                $request->logo->storeAs('files/company', $filename, 'public');
                $data['logo'] = $filename;
            }
            $update =   Company::where('id', $id)->update($data);
            $notification = array(
                'message' => 'Company Updated Successfully',
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
        $data = [
            "status" => '2'
        ];
        $deleted = Company::where('id', $id)->update($data);

        if ($deleted) {
            Employee::where('company_id', $id)->update(['status' => '2']);

            $notification = [
                'message' => 'Company Deleted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }

    }

}
