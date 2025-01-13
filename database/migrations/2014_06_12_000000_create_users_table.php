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
            $table->uuid('user_id', 50)->primary();
            $table->string('username', 150);
            $table->string('password', 100);
            $table->string('oldpassword', 100);
            $table->string('firstname', 150);
            $table->string('othername', 150);
            $table->string('user_fullname')->virtualAs("CONCAT(firstname, ' ', othername)");
            $table->string('salt', 100)->nullable();
            $table->string('telephone', 50);
            $table->string('telephone_verified', 50)->nullable();
            $table->string('expiry', 50)->nullable();
            $table->string('locked', 50)->default('No');
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('telephone_verified_at')->nullable();
            $table->string('gender', 100);
            $table->string('role_id', 50)->nullable();
            $table->string('mode', 100)->default('New')->nullable();
            $table->string('email')->unique();
            $table->string('email_verified', 20)->nullable();
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
            $table->foreign('facility_id')->references('facility_id')->on('facility');
            $table->foreign('role_id')->references('role_id')->on('user_roles');
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
    }
};
