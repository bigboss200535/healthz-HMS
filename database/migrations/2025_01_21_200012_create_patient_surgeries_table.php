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
        Schema::create('patient_surgeries', function (Blueprint $table) {
            $table->string('patient_id', 50);
            $table->string('opd_number', 50);
            $table->string('status_code', 50);
            $table->string('patient_age', 50);
            $table->timestamp('attendance_date');
            $table->timestamp('surgery_start_date');
            $table->timestamp('surgery_end_date');
            $table->string('surgery_doctor', 50);
            $table->string('theater_in_charge', 50);
            $table->string('surgery_type');
            $table->string('type_of_anaesthesia', 50); //local block, Epidural/Spinal, general Anaesthesia/ Local Anaedthesia
            $table->string('surgery_outcome');
            $table->string('anaesthesia_recorded');
            $table->string('assistant_one');
            $table->string('assistant_two');
            $table->string('scrub_nurse');
            $table->string('anaesthetist', 50)->nullable();
            $table->text('complications')->nullable();
            $table->text('complications')->nullable();
            $table->string('assistant_surgery_doctor');
            $table->text('surgery');
            $table->text('findings');
            $table->text('sponsor_id');
            $table->string('insured')->default('No');
            $table->string('age_category');
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
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('surgery_doctor')->references('user_id')->on('users');
            // $table->foreign('surgery_doctor')->references('user_id')->on('users');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_surgeries');
    }
};
