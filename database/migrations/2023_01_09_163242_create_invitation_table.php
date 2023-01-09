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
        Schema::create('invitation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('albums_id')->unsigned()->index()->nullable();
            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');
            $table->bigInteger('user_id_inviter')->unsigned()->index()->nullable();
            $table->foreign('user_id_inviter')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('user_id_invited')->unsigned()->index()->nullable();
            $table->foreign('user_id_invited')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('invitation');
    }
};
