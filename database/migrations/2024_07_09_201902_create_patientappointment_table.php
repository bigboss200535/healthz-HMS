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
        Schema::create('patient_appointment', function (Blueprint $table) {
            $table->string('appointment_id',50)->primary();
            $table->string('patient_id',50); 
            $table->string('facility_id', 50)->nullable();
            $table->string('opd_number',50)->nullable(); 
            $table->string('clinic_id',50)->nullable(); 
            $table->string('purpose',150)->nullable(); 
            $table->date('appointment_date')->nullable(); 
            $table->timestamp('appointment_time')->nullable(); 
            $table->date('request_date')->nullable(); 
            $table->string('user_id',50)->nullable();        
            $table->string('added_id', 50)->nullable();
            $table->string('added_by', 100)->nullable();
            $table->date('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->date('updated_date')->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->date('archived_date')->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('clinic_id')->references('clinic_id')->on('clinics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_appointment');
    }
};
