<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('comment_id');
            $table->foreign('comment_id')
                    ->references('id')
                    ->on('comments')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->text('reply');
            $table->boolean('is_approve')->nullable();
            $table->integer('userc_id')->unsignedBigInteger();
            $table->integer('useru_id')->nullable();
            $table->integer('userd_id')->nullable();
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
        Schema::dropIfExists('comment_replies');
    }
}
