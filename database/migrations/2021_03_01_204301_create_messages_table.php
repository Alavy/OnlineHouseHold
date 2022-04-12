<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('worker_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('owner_user_id');
            $table->boolean('isViewed')->default(false);
            $table->dateTime('sendTime');
            $table->timestamps();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
