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
        Schema::create('patient_daily_attendance', function (Blueprint $table) {
            $table->string('attendance_id', 50)->primary();
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
            $table->date('attendance_date');
            $table->date('attendance_time');
            $table->string('pat_age', 50);
            $table->string('registration_type', 50); //new or old
            $table->string('registration_status', 50); //old or new
            $table->string('insured', 50); //yes or no
            $table->string('episode_id', 50);
            $table->string('sponsor_id', 50);
            $table->string('clinic_id', 50);
            $table->string('age_category_id', 50);
            $table->string('user_id', 100)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->timestamp('archived_date')->nullable();
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });

        // DB::statement('ALTER TABLE patient_daily_attendance MODIFY episode_id INT AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_daily_attendance');
    }
};
