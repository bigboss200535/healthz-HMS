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
        Schema::create('facility', function (Blueprint $table) {
            $table->string('facility_id', 50)->primary();
            $table->string('facility_name', 250)->nullable();
            $table->string('slogan', 250)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('website', 200)->nullable();
            $table->string('fax', 150)->nullable();
            $table->string('health_facility_level_id', 50)->nullable();
            $table->string('logo', 150)->nullable();
            $table->string('ccc_type', 50)->default('Manual')->nullable();//manual or auto
            $table->string('levels', 100)->nullable();
            $table->string('allow_api_generation', 50)->default('No');
            $table->string('allow_nhis', 50)->default('No');
            $table->string('nhis_api', 1024)->nullable();
            $table->string('nhia_url', 1024)->nullable();
            $table->string('nhia_key', 1024)->nullable();
            $table->string('nhia_secret', 1024)->nullable();
            $table->string('nhia_desc', 150)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility');
    }
};
