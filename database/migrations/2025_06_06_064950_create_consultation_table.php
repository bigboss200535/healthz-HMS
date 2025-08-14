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
        Schema::create('patient_consultation', function (Blueprint $table) {
            $table->string('consultation_id', 50)->primary();
            $table->string('patient_id', 50)->nullable();
            $table->string('opd_number', 50)->nullable();
            $table->string('gender_id', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('age_group_id', 50)->nullable();
            $table->string('patient_age', 50)->nullable();
            $table->string('clinic', 50)->nullable();
            $table->string('patient_status_id', 50)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('is_insured', 50)->default('No')->nullable();
            $table->string('is_pregnant', 50)->default('No')->nullable();
            $table->string('sponsor_id', 50)->nullable();
            $table->string('sponsor_type_id', 50)->nullable();
            $table->string('episode_id', 50)->nullable();
            $table->string('episode_type', 50)->nullable();
            $table->string('consulting_room', 50)->nullable();
            $table->string('prescriber', 50)->nullable();
            $table->string('attendance_date', 50)->nullable();
            $table->string('consultation_date', 50)->nullable();
            $table->string('consultation_type', 50)->nullable();
            $table->string('consultation_time', 50)->nullable();
            $table->string('outcome', 50)->nullable();
            $table->string('attendance_id', 50)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 50)->default('Active')->index();
            $table->string('archived', 50)->default('No')->index();
            $table->string('archived_id', 50)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // foreign keys
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('age_id')->references('age_id')->on('ages');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
             $table->foreign('attendance_id')->references('attendance_id')->on('patient_attendance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_consultation');
    }
};
