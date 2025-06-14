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
        Schema::create('patient_attend_verify', function (Blueprint $table) {
            $table->string('attendance_verify', 50)->primary();
            $table->string('patient_id',50); 
            $table->string('opd_number',50); 
            $table->date('attendance_date',50)->nullable(); 
            $table->string('verification_code',50)->nullable(); 
            $table->string('transaction_id',50)->nullable(); 
            $table->string('card_status',50)->nullable();
            $table->date('valid_date',50)->nullable(); 
            $table->date('expiry_date',50)->nullable(); 
            $table->string('sponsor_id',50)->nullable(); 
            $table->string('hin_number',50)->nullable();
            $table->string('member_number',50)->nullable();  
            $table->string('same_details',50)->nullable(); 
            $table->string('patient_dob',50)->nullable(); 
            $table->string('patient_name',150)->nullable(); 
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
        Schema::dropIfExists('patient_attend_verify');
    }
};
