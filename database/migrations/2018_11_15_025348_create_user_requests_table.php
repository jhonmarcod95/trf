<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_name');
            $table->date('request_date');
            $table->string('purpose_of_travel');
            $table->string('contact_number');
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
            $table->string('traveler_name');
            $table->string('approved_by');
            $table->string('cost_center');
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
        Schema::dropIfExists('user_requests');
    }
}
