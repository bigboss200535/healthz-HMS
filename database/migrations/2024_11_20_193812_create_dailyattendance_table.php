<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('attendance_id', 50)->primary();
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
            $table->date('attendance_date');
            $table->timestamp('attendance_time'); 
            $table->string('pat_age', 50)->nullable(); 
            $table->string('age_id', 50)->nullable()->index(); 
            $table->string('gender_id', 50)->nullable()->index(); 
            $table->string('full_age', 50)->nullable(); 
            $table->string('age_group_id')->nullable();
            // $table->string('age_group_category', 50)->nullable(); 
            $table->string('status_code', 50)->nullable(); 
            $table->string('request_type', 20)->default('INWARD'); //inward and outward
            $table->string('service_id', 50)->nullable(); 
            $table->string('service_fee_id', 50)->nullable(); 
            $table->string('attendance_type_id', 50)->nullable(); 
            $table->string('insured', 50)->nullable()->default('No'); 
            $table->string('service_issued', 50)->default('0'); 
            $table->string('attendance_type', 50)->nullable(); 
            $table->string('episode_id', 50)->nullable(); 
            $table->string('sponsor_type_id', 50)->nullable(); 
            $table->string('sponsor_id', 50)->nullable(); 
            $table->string('service_point_id', 50)->nullable(); 
            $table->string('records_no', 50)->nullable(); 
            $table->string('attendance_no', 50)->nullable(); 
            $table->float('cash_amount',10)->default(0.00);
            $table->float('top_up',10)->default(0.00);
            $table->float('credit_amount',10)->default(0.00);  
            $table->string('gdrg_code',50)->nullable(); 
            $table->string('allow_top_up',10)->default('No');
            $table->string('user_id',50)->nullable();    
            $table->string('facility_id', 50)->nullable();    
            $table->string('added_id', 50)->nullable();
            $table->string('added_by', 100)->nullable();
            $table->date('added_date')->index()->default(DB::raw('CURRENT_DATE'));
            $table->string('updated_by', 100)->nullable();
            $table->date('updated_date')->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->date('archived_date')->nullable();
            $table->string('archived_by', 100)->nullable();
            // $table->primary(['attendance_id', 'added_date']);
            
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('status_code')->references('patient_status_id')->on('patient_statuses');
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
            $table->foreign('service_point_id')->references('service_point_id')->on('service_points');
            $table->foreign('attendance_type_id')->references('attendance_type_id')->on('service_attendance_type');
            $table->foreign('service_id')->references('service_id')->on('services');
            // attendance_type_id
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_attendance');
    }
};
