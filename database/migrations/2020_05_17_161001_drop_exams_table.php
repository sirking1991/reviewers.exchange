<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exams');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reviewer_id');
            $table->bigInteger('user_id');
            $table->dateTime('taken_on');
            $table->dateTime('completed_on');
            $table->integer('questionnaires_taken');
            $table->integer('corrent_answers');
            $table->double('result');            
            $table->timestamps();
        });
    }
}
