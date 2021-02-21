<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('sid');
            $table->string('name');
            $table->string('cover')->nullable();
            $table->string('publish_year');
            $table->string('isbn')->nullable();
            $table->text('describe')->nullable();
            $table->boolean('released')->default(false);
            $table->foreignId('subject_id');
            $table->foreignId('publisher_id');
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
