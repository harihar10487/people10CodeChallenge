<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWebHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_web_histories', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->ipAddress('ip_address');
            //$table->foreign('ip_address')->references('id')->on('employees');
            $table->string('url');
            $table->timestamps();            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_web_histories');
    }
}
