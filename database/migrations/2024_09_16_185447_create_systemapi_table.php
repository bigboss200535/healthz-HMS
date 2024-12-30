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
        Schema::create('system_apis', function (Blueprint $table) {
            $table->string('api_id', 50);
            $table->string('api_name', 100)->nullable();
            $table->text('api_url')->nullable();
            $table->text('api_key')->nullable();
            $table->string('api_secret', 500)->nullable();
            $table->string('api_type', 100)->nullable();
            $table->string('descriptions', 100)->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            $table->primary('api_id');
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
        Schema::dropIfExists('system_apis');
    }
};
