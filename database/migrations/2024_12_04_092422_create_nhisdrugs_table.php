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
        Schema::create('nhis_drugs', function (Blueprint $table) {
            $table->string('nhis_id', 50)->primary();
            $table->string('drug_name', 200)->nullable();
            $table->string('pricing_unit', 50)->nullable();
            $table->float('price')->nullable()->default('0.00');
            $table->string('prescription_level')->nullable();
            $table->string('is_active', 50)->nullable()->default('Yes');
            $table->string('pricing_factor', 50)->nullable()->default('0'); //0 or 1
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhis_drugs');
    }
};
