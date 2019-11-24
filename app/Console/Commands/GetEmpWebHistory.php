<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;
use App\EmployeeWebHistory;
class GetEmpWebHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GET:empwebhistory {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Employee details with his web search history stored under the variable [ip_address]. ';

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
        $bar = $this->output->createProgressBar(100);
        $employee_details = Employee::select('id','emp_id','epm_name', 'ip_address')
                  ->where('ip_address', $this->argument('ip_address'))->get()->toArray();   

        $employee['employee'] = [];

        array_push($employee['employee'], $employee_details);
        echo json_encode($employee);  
        if(sizeof($employee_details) == 0) {
            $this->error("Resource not found");
            $bar->advance();
            }
        else {
            $this->info("ip_address details");
            $this->table(['id','emp_id','epm_name','ip_address'],$employee_details);

            $empWebHistory = EmployeeWebHistory::select('id','ip_address','url')
              ->where('ip_address',$this->argument('ip_address'))->get()->toArray();
            $employeewebhistory['employeewebhistory'] = [];
            array_push($employeewebhistory['employeewebhistory'], $empWebHistory);
            echo json_encode($employeewebhistory);            
            $bar->advance(50);

            if(sizeof($empWebHistory) == 0) {
            $this->error("No emp web history found");
            } else {
                $this->info("\n\nEmp web history details");
                $this->table(['Id', 'ip_address','URL'],$empWebHistory);
                $this->info("\nTotal web history(s) : ".sizeof($empWebHistory));
                $bar->advance(50);
            }
        }
        $bar->finish();
        $this->info(''); // this is for new line
    }
}
