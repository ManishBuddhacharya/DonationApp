<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title');
            $table->text('content');

            $table->boolean('is_active')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->integer('useru_id')->nullable();
            $table->integer('userd_id')->nullable();
            $table->timestamp('deleted_at')->nullable();

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
        Schema::dropIfExists('story');
    }
}
