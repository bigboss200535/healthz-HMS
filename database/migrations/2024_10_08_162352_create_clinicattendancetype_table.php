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
        
        Schema::create('service_attendance_type', function (Blueprint $table) {
            $table->string('attendance_type_id', 50)->primary();
            $table->string('attendance_type',150); 
            $table->string('status_code',50)->nullable(); 
            $table->string('gender_id',50)->nullable(); 
            $table->string('age_id',50)->nullable();   
            $table->string('child_code',50)->nullable();
            $table->string('adult_code',50)->nullable()->index(); 
            $table->string('clinic_id',50)->nullable()->index();  
            $table->string('type_code',50)->nullable();  
            $table->string('patient_status_id',50)->nullable();  
            $table->string('facility_id', 50)->nullable(); 
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
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('clinic_id')->references('clinic_id')->on('clinics');
            $table->foreign('patient_status_id')->references('patient_status_id')->on('patient_statuses');
            // $table->foreign('adult_code_id')->references('service_fee_id')->on('services_fee');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_attendance_type');
    }
};
