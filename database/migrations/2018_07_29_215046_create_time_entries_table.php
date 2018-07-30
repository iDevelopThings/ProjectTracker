<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->id();
            $table->integer('user_id')->unsigned()->id();
            $table->date('date');
            $table->time('start_time')->nullable();
            $table->time('finish_time')->nullable();
            $table->string('length_in_seconds')->nullable();
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('time_entries');
    }
}
