<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyApiController extends Controller
{
    public function companyDetails($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json([
                'status' => false, 
                'message' => 'Company not found'
            ], 404);
        }
        return response()->json([
            'status' => true, 
            'message' => 'Company details found successfully', 
            'data' => $company
        ], 200);
    }

    public function companyAdd(AddCompanyRequest $request)
    {

        $data = array(
            'name'       => $request->name,
            'email'      => $request->email,
            'website'    => $request->website,
            'status'     => '1',
            'created_at' => now(),
            'updated_at' => now(),
        );
        $checkCompany = Company::where('name', $request->name)->first();

        if ($checkCompany) {
            return response()->json([
                'status' => false,
                'message' => 'Company Already Exists', 
            ], 400);
        }

        if ($request->hasFile('logo')) {
            $filename = 'logo_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('files/company', $filename, 'public');
            $data['logo'] = $filename;
        }

        $company = Company::create($data);

        return response()->json([
            'status' => true, 
            'message' => 'Company Inserted Successfully', 
            'data' => $company
        ], 200);
    }
}
