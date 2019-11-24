<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;
use App\EmployeeWebHistory;
class SetEmpWebHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SET:empwebhistory {ip_address} {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert the Emp Web History.';

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
        $input['ip_address'] = $this->argument('ip_address');
        $input['url'] = $this->argument('url');

        $employee = Employee::where('ip_address', $input['ip_address'])->get()->toArray();
        if(sizeof($employee) == 0) {
            $this->error("ip_address doesn't exists.");          
            
        }else{
            $empWebHistory = new EmployeeWebHistory;
            $empWebHistory->url = $input['url'];
            $empWebHistory->ip_address = $input['ip_address'];
            $empWebHistory->save();
            $this->info("Employee Web History inserted successfully.");
        }
    }
}
