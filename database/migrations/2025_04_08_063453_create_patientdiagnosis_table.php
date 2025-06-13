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
        Schema::create('patient_diagnosis', function (Blueprint $table) {
            $table->string('attendance_diagnosis_id', 50)->primary();
            $table->string('consultation_id', 50)->nullable();
            $table->string('attendance_id', 50)->nullable();
            $table->string('patient_id', 50)->nullable();
            $table->string('age_group_id', 50)->nullable();
            $table->string('opd_number', 50)->nullable();
            $table->date('attendance_date')->nullable();
            $table->timestamp('attendance_time')->nullable()->default(DB::raw('CURRENT_DATE'));
            $table->date('entry_date')->nullable();
            $table->string('episode_id', 50)->nullable();
            $table->string('diagnosis_id', 50)->nullable();
            $table->string('diagnosis_type', 50)->nullable();
            $table->string('diagnosis_category', 50)->nullable();
            $table->string('diagnosis_fee', 150)->nullable();
            $table->string('icd_10', 50)->nullable();
            $table->string('gdrg_code', 50)->nullable();
            $table->string('is_principal', 50)->nullable()->default('No');
            $table->string('is_active', 50)->nullable();
            $table->string('doctor_id', 50)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 50)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // Foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('diagnosis_id')->references('diagnosis_id')->on('diagnosis');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('doctor_id')->references('user_id')->on('users');
            $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_diagnosis');
    }
};
