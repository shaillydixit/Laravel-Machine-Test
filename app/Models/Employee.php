<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function check_employee($data, $employeeId)
	{
		$employees = DB::table('employees')
					->where('status', '=', '1')
					->where('email', '=', $data['email'])
					->where('company_id', '=', $data['company_id'])
					->where('id', '!=', $employeeId)
					->first();
		return $employees;
	}

	public function Company()
	{
		return $this->belongsTo(Company::class, 'company_id', 'id');		
	}
}
