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
        Schema::create('patient_attendance', function (Blueprint $table) {
            $table->string('patient_id', 50);
            $table->string('opd_number', 50)->nullable();
            $table->date('attendance_date')->nullable();
            $table->timestamp('attendance_time')->nullable(); 
            $table->string('pat_age')->nullable(); 
            $table->string('status_code')->nullable(); 
            $table->string('reg_type')->nullable(); 
            $table->string('service_type')->nullable(); 
            $table->string('reg_status')->nullable(); 
            $table->string('membership_number')->nullable(); 
            $table->string('insured')->nullable(); 
            $table->string('service_issued')->default('0'); 
            $table->string('claims_check_code')->nullable(); 
            $table->string('episode_id')->nullable(); 
            $table->string('sponsor_id')->nullable(); 
            $table->string('clinic_code')->nullable(); 
            $table->string('records_no')->nullable(); 
            $table->string('attendance_no')->nullable(); 
            $table->string('gender_id',50)->nullable(); 
            $table->string('age_id',50)->nullable(); 
            $table->string('cash_amount',50)->nullable();
            $table->string('top_up',50)->nullable();
            $table->string('credit_amount',50)->nullable();  
            $table->string('gdrg_code',50)->nullable(); 
            $table->string('user_id',50)->nullable();    
            $table->string('facility_id', 50)->nullable();    
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
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_request');
    }
};
