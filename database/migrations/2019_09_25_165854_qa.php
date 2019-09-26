<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Qa extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->string('score');
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')
                ->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_correct');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
    }
}
