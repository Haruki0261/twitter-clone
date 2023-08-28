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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('following_id')->comment('フォローしているユーザ-ID');
            $table->unsignedBigInteger('followed_id')->comment('フォローされているユーザ-ID');
            $table->timestamps();

            $table->index('following_id');
            $table->index('followed_id');

            $table->unique([
                'following_id',
                'followed_id'
            ]);

            $table->foreign('followed_id')->references('id')->on('users');
            $table->foreign('following_id')->references('id')->on('users');
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
};
