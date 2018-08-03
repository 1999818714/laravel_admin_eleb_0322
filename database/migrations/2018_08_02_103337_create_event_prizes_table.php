<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_prizes', function (Blueprint $table) {
            $table->increments('id')->comment('抽奖活动奖品表');
            $table->integer('events_id')->comment('活动id');
            $table->string('name')->comment('奖品名称');
            $table->text('description')->comment('奖品详情');
            $table->integer('member_id')->comment('中奖商家账号id');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_prizes');
    }
}
