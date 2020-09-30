<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->dateTime('request_date');
            $table->boolean('status'); //(0: waiting(default), 1: accepted, 2: canceled, 3: transfered, 4: reterned, 5: expired)
            $table->longText('note')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('device_id');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('device_id')->references('id')->on('devices');
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
        Schema::dropIfExists('borrows');
    }
}
