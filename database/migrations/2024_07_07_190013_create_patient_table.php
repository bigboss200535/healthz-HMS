<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        

       Schema::create('patient_info', function (Blueprint $table) {
            $table->string('patient_id', 50)->primary();
            $table->string('title_id', 50)->nullable();
            $table->string('firstname', 100)->nullable()->index();
            $table->string('middlename', 100)->nullable()->index();
            $table->string('lastname', 100)->nullable()->index();
            $table->string('fullname')->virtualAs("CONCAT(firstname, ' ', middlename, ' ', lastname)");
            $table->date('birth_date')->nullable();
            $table->string('gender_id', 50)->nullable();
            $table->string('occupation_id', 50)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('religion_id', 50)->nullable();
            $table->string('nationality_id', 50)->nullable();
            $table->string('ghana_card', 50)->nullable();
            $table->string('old_folder', 100)->nullable();
            $table->string('death_status', 100)->default('No');
            $table->date('death_status_date', 100)->nullable();
            $table->string('telephone', 50)->nullable()->index();
            $table->string('work_telephone', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('town', 100)->nullable();
            $table->string('region', 100)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('dependant', 50)->nullable();
            $table->string('email_verified', 20)->default('No');
            $table->string('telephone_verified', 20)->default('No');
            $table->string('allow_sms', 50)->default('No');
            $table->string('blood_group', 50)->nullable();
            $table->string('allow_email', 50)->default('No');
            $table->string('records_id', 100)->nullable();
            $table->string('opd_type', 50)->nullable();
            $table->date('register_date')->nullable()->default(DB::raw('CURRENT_DATE'));
            $table->string('user_id', 100)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('religion_id')->references('religion_id')->on('religion');
            $table->foreign('title_id')->references('title_id')->on('title');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('occupation_id')->references('occupation_id')->on('occupation');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('nationality_id')->references('nationality_id')->on('nationality');
        });

        Schema::create('patient_nos', function (Blueprint $table) {
            $table->string('patient_id', 50)->index();
            $table->string('opd_number', 50)->index();
            $table->string('clinic_id', 100)->nullable();
            $table->date('registration_date')->nullable();
            $table->timestamp('registration_time')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('clinic_id')->references('clinic_id')->on('clinics');
        });

        Schema::create('patient_pics', function (Blueprint $table) {
            $table->string('patient_id', 50)->index();
            $table->string('opd_number', 50)->index();
            $table->string('image', 50);
            $table->string('image_location', 50)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
            $table->foreign('facility_id')->references('facility_id')->on('facility');           
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
        });

         Schema::create('patient_appointment', function (Blueprint $table) {
            $table->string('appointment_id',50)->primary();
            $table->string('patient_id',50); 
            $table->string('opd_number', 50)->index()->nullable();
            $table->string('facility_id', 50)->nullable();
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
            
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('clinic_id')->references('clinic_id')->on('clinics');
        });

         Schema::create('patient_vitals', function (Blueprint $table) {
            $table->string('vital_id', 50)->primary();
            $table->string('patient_id',50)->nullable(); 
            $table->string('opd_number',50)->nullable(); 
            $table->string('pat_age',50)->nullable(); 
            $table->string('temperature',50)->nullable(); 
            $table->string('height',50)->nullable(); 
            $table->string('weight',50)->nullable(); 
            $table->string('diastolic',50)->nullable(); 
            $table->string('systolic',50)->nullable(); 
            $table->string('pulse_rate',50)->nullable(); 
            $table->string('oxygen_saturation',50)->nullable(); 
            $table->string('respiratory_rate',50)->nullable(); 
            $table->string('rdt',50)->nullable();
            $table->string('remarks',300)->nullable();
            $table->string('fbs',50)->nullable();  
            $table->string('rbs',50)->nullable();  
            $table->string('bmi',50)->nullable();  
            $table->date('request_date')->nullable(); 
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
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
        });

        Schema::create('relation', function (Blueprint $table) {
            $table->string('relation_id', 50)->primary();
            $table->string('relation',50)->nullable(); 
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
            
        });

        Schema::create('patient_sponsorship', function (Blueprint $table) {
            $table->id('patient_sponsor_id');
            $table->string('patient_id', 50)->index();
            $table->string('opd_number', 20)->nullable();
            $table->string('member_no', 50);
            $table->string('sponsor_id', 50)->nullable();
            $table->string('sponsor_type_id', 50)->nullable();
            $table->string('card_serial', 50)->nullable();
            $table->date('start_date', 100)->nullable();
            $table->date('end_date', 100)->nullable();
            $table->string('dependant', 50)->default('0');
            $table->string('records_id', 100)->nullable();
            $table->string('priority', 100)->nullable();
            $table->string('facility_id', 50)->nullable(); 
            $table->string('is_active', 100)->default('Yes');
            $table->string('user_id', 100)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
             $table->foreign('added_id')->references('user_id')->on('users');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });

        Schema::create('patient_attendance', function (Blueprint $table) {
            $table->string('attendance_id', 50)->primary();
            $table->string('patient_id', 50)->index();
            $table->string('opd_number', 50)->index();
            $table->timestamp('attendance_date')->nullable();
            $table->timestamp('attendance_time')->nullable(); 
            $table->string('age_id', 50)->nullable()->index(); 
            $table->string('pat_age', 50)->nullable(); 
            $table->string('full_age', 50)->nullable(); 
            $table->string('gender_id', 50)->nullable()->index(); 
            $table->string('age_group_id')->nullable();
            $table->string('status_code', 50)->nullable(); 
            $table->string('request_type', 20)->default('INWARD'); //inward and outward
            $table->string('service_id', 50)->nullable(); 
            $table->string('service_fee_id', 50)->nullable(); 
            $table->string('attendance_type_id', 50)->nullable(); 
            $table->string('insured', 50)->nullable()->default('No'); 
            $table->string('issue_id', 50)->default('0'); 
            $table->string('vital_added', 50)->default('0'); 
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
            $table->string('consultation_status',20)->default('Waiting');// waiting, hold, completed etc
            $table->string('consultation_outcome',20)->default('Waiting');// discharged, pending diagnostics, admitted etc
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
            $table->foreign('added_id')->references('user_id')->on('users');
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
            $table->foreign('service_fee_id')->references('service_fee_id')->on('services_fee');
            $table->foreign('issue_id')->references('issue_id')->on('consultation_issue_status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_info');
        Schema::dropIfExists('patient_nos');
        Schema::dropIfExists('patient_pics');
        Schema::dropIfExists('patient_appointment');
        Schema::dropIfExists('patient_vitals');
        Schema::dropIfExists('relation');
        Schema::dropIfExists('patient_sponsorship');
        Schema::dropIfExists('patient_attendance');
    }
};
