<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function check_company($data,$companyId)
	{
		 $companies = DB::table('companies') 
					->where('status', '=', '1')
					->where('name', '=', $data['name'])
					->where('id', '!=', $companyId)
				 	->first();
		return $companies;		
	}

    
}
