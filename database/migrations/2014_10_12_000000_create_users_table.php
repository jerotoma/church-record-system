<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->dateTime('last_success_login')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('enabled')->default(false);
            $table->boolean('locked')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->timestamp('username_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
