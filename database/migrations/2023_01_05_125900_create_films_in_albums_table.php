<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_in_albums', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('albums_id')->unsigned()->index()->nullable();
            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');
            $table->Integer('films_id');
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
        Schema::dropIfExists('films_in_albums');
    }
};
