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
        Schema::create('patient_statuses', function (Blueprint $table) {
            $table->string('patient_status_id', 50)->primary();//1,2,3
            $table->string('patient_status', 50)->nullable(); //all, out, in
            $table->string('user_id', 50)->nullable();
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
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });

       Schema::create('patient_info', function (Blueprint $table) {
            $table->string('patient_id', 50)->primary();
            $table->string('title_id', 50)->nullable();
            $table->string('firstname', 100)->nullable();
            $table->string('middlename', 100)->nullable();
            $table->string('lastname', 100)->nullable();
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
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
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
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
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
        Schema::dropIfExists('patient_status');
        Schema::dropIfExists('patient_info');
        Schema::dropIfExists('patient_nos');
        Schema::dropIfExists('patient_pics');
        Schema::dropIfExists('patient_appointment');
        Schema::dropIfExists('patient_vitals');
    }
};
