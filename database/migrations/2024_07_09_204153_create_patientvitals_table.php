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
        Schema::create('patient_vitals', function (Blueprint $table) {
            $table->string('vital_id', 50)->primary();
            $table->string('patient_id',50)->nullable(); 
            $table->string('opd_number',50)->nullable(); 
            $table->string('pat_age',50); 
            $table->string('temperature',50)->nullable(); 
            $table->string('height',50)->nullable(); 
            $table->string('weight',50)->nullable(); 
            $table->string('diastolic',50)->nullable(); 
            $table->string('systolic',50)->nullable(); 
            $table->string('pulse_rate',50)->nullable(); 
            $table->string('respiratory_rate',50)->nullable(); 
            // $table->string('spo2',50);
            $table->string('remarks',300)->nullable();
            // $table->string('fbs_rbs',50);  
            $table->string('bmi',50)->nullable();  
            $table->date('request_date'); 
            $table->timestamp('request_time'); 
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
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
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
        Schema::dropIfExists('patient_vitals');
    }
};
