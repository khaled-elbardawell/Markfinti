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
            $table->string('fname',10);
            $table->string('lname',10);
            $table->string('password');
            $table->string('address',20);
            $table->string('photo',200)->nullable();;
            $table->string('phone',20)->unique();;
            $table->string('email',30)->unique();
            $table->string('identity',20)->nullable();
            $table->string('position',20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('role',1);
            $table->bigInteger('manger_id')->unsigned()->nullable();
            $table->foreign('manger_id')->references('id')->on('users');
            $table->enum('active',['0','1'])->default('1');
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
