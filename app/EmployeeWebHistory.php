<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class EmployeeWebHistory extends Model
{
	use SoftDeletes;
    /**
     * Get the web histories for the Employee.
     */
	public function emp_ip_address()
	{
		return $this->belongsTo(Employee::class, 'id', 'ip_address');	
	}
}
