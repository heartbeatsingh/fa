<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Flops extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('flops', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('from_user');
            $table->integer('to_user');
            $table->integer('actioned_by');
            $table->enum('status',['pending','approved']);
            $table->dateTime('send_time');
            $table->dateTime('received_time');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('flops');
    }

}
