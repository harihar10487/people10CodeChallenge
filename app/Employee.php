<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
	use SoftDeletes;
    protected $fillable = ['emp_id', 'epm_name', 'ip_address'];
   
   /**
     * Get the web histories for the Employee.
     */
	public function emp_web_histories()
	{
		return $this->hasMany(EmployeeWebHistory::class, 'ip_address', 'id');	
	}

}
