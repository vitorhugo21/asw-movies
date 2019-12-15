<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_movies')) {
            Schema::create('user_movies', function (Blueprint $table) {
                $table->unsignedBigInteger('movie_id');
                $table->unsignedBigInteger('user_id');
                $table->boolean('watch_later')->default(false);
                $table->boolean('favorite')->default(false);
                $table->boolean('viewed')->default(false);
                $table->timestamps();
                $table->unique(['movie_id', 'user_id']);
                $table->foreign('user_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_movies');
    }
}
