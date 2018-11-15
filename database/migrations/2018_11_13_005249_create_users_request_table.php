<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRequestTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
    public function up()
    {
        Schema::create('users_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_number');
            $table->integer('company_name');
            $table->date('request_date');
            $table->string('purpose_of_travel');
            $table->integer('contact_number');
            $table->integer('destination');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('baggage_allowance');
            $table->string('budget_code_line');
            $table->string('budget_code_approved');
            $table->string('budget_available');
            $table->string('gl_account');
            $table->integer('requestor_id');
            $table->integer('status');
            
            $table->timestamps();
        });
        
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('users_request');
    }
}
