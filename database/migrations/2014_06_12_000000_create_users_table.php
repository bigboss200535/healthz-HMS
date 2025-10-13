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
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 50)->primary();
            $table->string('username', 150)->index();
            $table->string('password', 100);
            $table->string('oldpassword', 100);
            $table->string('title', 50)->nullable();
            $table->string('salt', 50)->nullable();
            $table->string('firstname', 150);
            $table->string('othername', 150);
            $table->string('user_fullname')->virtualAs("CONCAT(firstname, ' ', othername)");
            $table->string('telephone', 50);
            $table->timestamp('last_login')->nullable();
            $table->string('telephone_verified', 50)->default('No')->nullable();
            $table->string('expiry', 50)->nullable();
            $table->string('locked', 50)->default('No');
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('telephone_verified_at')->nullable();
            $table->string('gender_id', 50);
            $table->string('user_roles_id', 50)->nullable();
            $table->string('mode', 50)->default('New')->nullable();
            $table->string('email')->nullable()->unique()->index();
            $table->string('email_verified', 20)->nullable()->default('No');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 100)->nullable();
            $table->timestamp('added_date')->nullable()->index();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 100)->default('Active')->index();
            $table->string('archived', 100)->default('No')->index();
            $table->string('archived_id', 100)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // key
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('gender_id')->references('gender_id')->on('gender');
            $table->foreign('user_roles_id')->references('user_roles_id')->on('user_roles');
        });

        Schema::create('user_access_level', function (Blueprint $table) {
            $table->string('user_no',50);
            $table->string('add',150); 
            $table->string('edit',150); 
            $table->string('view',150); 
            $table->string('delete',150); 
            $table->string('print',150); 
            $table->string('accesslevel',150); 
            $table->string('facility_id', 50)->nullable();
            $table->timestamp('registered_date')->nullable(); 
            $table->string('user_id',50);        
            $table->string('added_id', 50)->nullable();
            $table->string('added_by', 100)->nullable();
            $table->date('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->date('updated_date')->nullable();
            $table->string('status', 100)->default('Active');
            $table->string('archived', 100)->default('No');
            $table->date('archived_date')->nullable();
            $table->string('archived_by', 100)->nullable();
            
            // key
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('facility_id')->references('facility_id')->on('facility');
        });

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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_access_level');
        Schema::dropIfExists('user_logs');
    }
};
