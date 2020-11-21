<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('ユーザーID');
            $table->foreignId('friend_id')->comment('フレンドユーザーID');
            $table->foreignId('group_id')->comment('グループID');
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
        Schema::dropIfExists('group_invites');
    }
}
