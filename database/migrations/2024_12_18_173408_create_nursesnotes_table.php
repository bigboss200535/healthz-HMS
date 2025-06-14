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
        Schema::create('admission_nurses_notes', function (Blueprint $table) {
            $table->id('notes_id', 50);
            $table->string('patient_age', 50)->nullable();
            $table->string('patient_id', 50)->nullable();
            $table->string('pat_number', 50)->nullable();
            $table->string('episode_id', 50)->nullable();
            $table->text('notes')->nullable();
            $table->string('ward_id',50)->nullable();
            $table->string('bed_id')->nullable();
            $table->string('admissions_id')->nullable();
            $table->date('notes_date', 50)->nullable();
            $table->timestamp('notes_time')->nullable();
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
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('patient_id')->references('patient_id')->on('patient_info');
            // $table->foreign('store_id')->references('store_id')->on('stores');
            // $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_nurses_notes');
    }
};
