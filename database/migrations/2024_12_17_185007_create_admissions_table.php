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
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->string('admissions_id', 50);
            $table->string('episode_id', 50)->nullable();
            $table->string('patient_id', 50)->nullable();
            $table->string('patient_opd')->nullable();
            $table->string('ward_id', 50)->nullable();
            $table->string('bed_id', 50)->nullable();
            $table->string('discharge_status')->nullable();
            $table->string('discharge_date', 10)->nullable();
            $table->string('ward_transfer')->nullable();
            $table->string('doctor_id', 50)->nullable();
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
            $table->foreign('bed_id')->references('bed_id')->on('admission_beds');
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
        Schema::dropIfExists('patient_admissions');
    }
};
