<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDestinationsTable extends Migration
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
        Schema::create('user_destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->integer('origin');
            $table->integer('destination');
            $table->date('date_of_travel');
            $table->string('time_appointment');
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
        Schema::dropIfExists('user_destinations');
    }
}
