<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< Updated upstream
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
=======
            Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->nullable(false)->change();
            $table->string('apellidos',100);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telefono',11);
            $table->bigInteger('nivel');
>>>>>>> Stashed changes
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
