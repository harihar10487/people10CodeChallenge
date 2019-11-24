<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;

class UnSetEmpData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UNSET:empdata {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Soft delete the data  having the passed ip_address.';

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
        $employee_details = Employee::where('ip_address', $this->argument('ip_address'))->get()->toArray();        

        if(sizeof($employee_details) == 0) {
            $this->error("Resource not found.");
            $bar->advance();
        }
        else {
            Employee::where('ip_address', $this->argument('ip_address'))->delete();
            $this->info("ip_address deleted successfully.");            
            $bar->advance(50);
        }
        $bar->finish();
        $this->info(''); // this is for new line
    }
}
