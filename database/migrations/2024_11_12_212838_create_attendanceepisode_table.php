<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_episode', function (Blueprint $table) {
            $table->id('episode_id');
            $table->string('patient_id', 50)->nullable();
            $table->string('pat_number', 50)->nullable();
            $table->date('request_date', 50)->nullable();
            $table->string('episode_clinic', 100)->nullable();
            $table->string('code', 100)->nullable(); 
            $table->string('user_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // $table->primary('episode_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_episode');
    }
};
