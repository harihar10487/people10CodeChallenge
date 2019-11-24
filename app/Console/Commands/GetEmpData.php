<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;
class GetEmpData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GET:empdata {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the employee details having the ip_address.';

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

        if(sizeof($employee_details) == 0) {
            $this->error("Resource not found");
            $bar->advance();
            }
        else {
            $this->info("ip_address details");
            $this->table(['id','emp_id','epm_name','ip_address'],$employee_details);
            $this->info("\nTotal Employee(s) : ".sizeof($empWebHistory));
            $bar->advance(50);
        }
        $bar->finish();
        $this->info(''); // this is for new line

    }
}
