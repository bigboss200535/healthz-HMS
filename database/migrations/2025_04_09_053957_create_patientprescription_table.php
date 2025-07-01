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
        Schema::create('patient_prescription', function (Blueprint $table) {
            $table->string('prescriptions_id', 50)->primary();
            $table->string('attendance_id', 50)->nullable();
            $table->string('patient_id', 50)->nullable();
            $table->string('opd_number', 50)->nullable();
            $table->date('attendance_date')->nullable();
            $table->timestamp('attendance_time')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('age_group_id', 50)->nullable();
            $table->string('presentation', 50)->nullable();
            $table->string('age_id', 50)->nullable();
            $table->string('episode_id', 200)->nullable();
            $table->float('unit_price', 50)->nullable();
            $table->string('product_id', 50)->nullable();
            $table->string('prescription_type', 50)->nullable();
            $table->string('sponsor_id', 50)->nullable();
            $table->string('sponsor_type_id', 50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('store_id', 50)->nullable();
            $table->string('dosage', 50)->nullable();
            $table->string('unit_measure', 50)->nullable(); //tab, capsule, ml, etc
            $table->string('frequencies', 50)->nullable();
            $table->string('duration', 50)->nullable();
            $table->float('quantity_given', 50)->nullable();
            $table->float('quantity_serve', 50)->nullable();
            $table->string('gdrg_code', 50)->nullable();
            $table->string('doctor_id', 50)->nullable();
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
            // keys
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('age_group_id')->references('age_group_id')->on('age_groups');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('sponsor_type_id')->references('sponsor_type_id')->on('sponsor_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_prescription');
    }
};
