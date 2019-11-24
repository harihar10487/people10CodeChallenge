<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Employee;
use Illuminate\Http\Request;
use Auth;
use Validator;
class EmployeeController extends BaseController
{
   
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[ 
            'emp_id' => 'required',
            'epm_name' => 'required',
            'ip_address' => 'required',
            ]);  

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  

        $employee = Employee::create($input);
        return $this->sendResponse($employee->toArray(), 'Employee created successfully.');      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($ip_address)
    {

        $employee = Employee::where('ip_address', $ip_address)->first();
        if (is_null($employee)) {
            return $this->sendError('Employee not found.');
        } 
        return $this->sendResponse($employee->toArray(), 'Employee found successfully.');    
       
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //dump($employee);
        $input = $request->all();
        //dd($input);
        $validator = Validator::make($input, [
            'emp_id' => 'required',
            'epm_name' => 'required',
            'ip_address' => 'required',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $employee = Employee::where('ip_address', $ip_address)->first();
        $employee->emp_id = $input['emp_id'];
        $employee->epm_name = $input['epm_name'];
        $employee->save();

        return $this->sendResponse($employee->toArray(), 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($ip_address, Employee $employee)
    {
        $emp = $employee::where('ip_address', $ip_address)->first();
       
        if (!$emp) {
            $error ='Employee with ip_address ' . $ip_address . ' not found';
            return $this->sendError($error, '', 400);  
        }
 
        if ($employee::where('ip_address', $emp->ip_address)->delete()) {  

             return $this->sendResponse($employee->toArray(), 'Employee ip_address deleted successfully.');  

        } else { 
            return $this->sendError('Employee ip_address could not be deleted', '', 500); 
        }
    }

}
