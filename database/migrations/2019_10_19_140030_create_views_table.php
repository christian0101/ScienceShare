<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->primary(['identifier', 'post_id'], 'identifier_post');
            $table->string('identifier')->unique();
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->
              on('posts')->onDelete('cascade')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views');
    }
}
