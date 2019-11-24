<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;

class SetEmpData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SET:empdata 
    {emp_id : Employee Id.} 
    {emp_name : Employee Name.}  
    {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert the employee details to employee table with data emp_id, emp_name, ip_address';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $input['emp_id'] = $this->argument('emp_id');
        $input['epm_name'] = $this->argument('emp_name');
        $input['ip_address'] = $this->argument('ip_address');

        $employee = Employee::where('ip_address', $input['ip_address'])->first();
        if (is_null($employee)) {            
            $employee = new Employee;
            $employee->emp_id = $input['emp_id'];
            $employee->epm_name = $input['epm_name'];
            $employee->ip_address = $input['ip_address'];
            $employee->save();
            $this->line("Employee inserted successfully.");
        }else{
            $this->error("ip_address already exists.");
        }
                
    }
}
