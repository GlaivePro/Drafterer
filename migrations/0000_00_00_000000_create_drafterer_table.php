<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftererTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drafterer', function (Blueprint $table) {
            $table->increments('id');
			
            $table->integer('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('attribute')->nullable();
            $table->mediumText('value')->nullable();
			
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
        Schema::dropIfExists('drafterer');
    }
}
