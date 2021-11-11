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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 75)->nulalble(false)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('name', 100)->nullable(false);
            $table->string('surname', 100)->nullable(false);
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('description', 500)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_trainer')->default(false);
            $table->rememberToken();
            $table->timestamps();
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
}
