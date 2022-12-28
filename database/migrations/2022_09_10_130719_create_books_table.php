<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('author');
            $table->string('title');
            $table->string('cover');
            $table->integer('price');
            $table->string('chapter');
            $table->integer('group_id');
            $table->enum('popular',[0,1])->default(0);
            $table->enum('type', ['all', 'one']);
            $table->enum('status', ['ongoing', 'finish'])->default('ongoing');
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
        Schema::dropIfExists('books');
    }
}
