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
        Schema::create('wards', function (Blueprint $table) {
            $table->string('ward_id')->primary();
            $table->string('ward_name')->nullable();
            $table->string('ward_status')->nullable();
            $table->string('ward_gender')->nullable();
            $table->string('bed_number')->nullable();
            $table->string('gender_id')->nullable();
            $table->string('age_id')->nullable();
            $table->string('initial_bed_state')->nullable();
            $table->string('ward_type')->nullable();
            $table->string('rb_total')->nullable();
            $table->string('vb_total')->nullable();
            $table->string('arb_total')->nullable();
            $table->string('avb_total')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
};
