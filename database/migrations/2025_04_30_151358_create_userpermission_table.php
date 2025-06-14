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
        // users specific permissions here
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id('user_permissions_id', 50);
            $table->string('user_id', 50)->nullable();
            $table->string('user_roles_id', 50)->nullable();
            $table->string('permission_id', 50);
            $table->string('role_id', 50)->nullable();
            $table->boolean('is_granted')->default(true);
            $table->string('can_read', 20)->nullable()->default('0');
            $table->string('can_create', 20)->nullable()->default('0');
            $table->string('can_delete', 20)->nullable()->default('0');
            $table->string('can_update', 20)->nullable()->default('0');
            $table->string('facility_id', 50)->nullable();
            $table->string('added_id', 50)->nullable();
            $table->timestamp('added_date')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->string('status', 50)->default('Active')->index();
            $table->string('archived', 50)->default('No')->index();
            $table->string('archived_id', 50)->nullable();
            $table->string('archived_by', 100)->nullable();
            $table->date('archived_date', 100)->nullable();
            // Foreign key 
            $table->foreign('user_roles_id')->references('user_roles_id')->on('user_roles');
            $table->foreign('role_id')->references('role_id')->on('permission_role');
            $table->foreign('permission_id')->references('permission_id')->on('permissions');
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
        Schema::dropIfExists('user_permissions');
    }
};