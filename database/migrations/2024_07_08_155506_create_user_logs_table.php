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
       Schema::create('user_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('user_id', 50)->nullable();
            $table->string('logname',50)->nullable();
            $table->date('login_date')->nullable();
            $table->date('logout_date')->nullable();
            $table->timestamp('login_time')->nullable();
            $table->string('session_id',100)->nullable();
            $table->timestamp('logout_time')->nullable();
            $table->string('user_ip', 100)->nullable();
            $table->string('user_pc')->nullable();
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
          Schema::dropIfExists('user_logs');
    }
};
