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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('consult_id');
            $table->date('consult_date');
            $table->date('consult_time');
            $table->string('consult_type');
            $table->date('attendance_date');
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
            $table->string('status_code', 50);
            $table->string('patiient_age', 50);
            $table->string('sponsor_name', 50);
            $table->string('is_insured', 50)->default('No');
            $table->string('doctor_id', 50)->default('No');
            $table->string('episode_type', 50)->nullable();//acute, chronic, emergency
            $table->string('episode_id', 50)->nullable();
            $table->string('clinic_id', 50)->nullable();
            $table->string('age_class', 50)->nullable();
            $table->string('is_pregnant', 50)->nullable();
            $table->string('consulting_room_id', 50)->nullable();
            $table->text('treatment_plan')->nullable();
            $table->string('admission_ward', 200)->nullable();
            $table->string('user_id', 10)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            // $table->foreign('store_id')->references('store_id')->on('stores');
            // $table->foreign('bed_id')->references('bed_id')->on('admission_beds');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
