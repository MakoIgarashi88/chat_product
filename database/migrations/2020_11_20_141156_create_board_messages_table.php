<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->longText('body')->nullable()->comment('メッセージ内容');
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
        Schema::dropIfExists('board_messages');
    }
}
