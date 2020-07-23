<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->text('discription');
            $table->float('budget');
            $table->enum('is_complete',['0','1'])->default('0');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('progress_id')->unsigned()->nullable();;
            $table->foreign('progress_id')->references('id')->on('progress')->onDelete('cascade');
            $table->date('complete_date')->nullable();
            $table->integer('code_number');
            $table->enum('is_deleted',['0','1'])->default('0');
            $table->bigInteger('user_id')->unsigned()->nullable();;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('manger_id')->unsigned()->nullable();;
            $table->foreign('manger_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
    }
}
