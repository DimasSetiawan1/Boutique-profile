<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhilosophiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('philosophies', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable()->unique();
            $table->string('title_en');
            $table->string('title_id');
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_id')->nullable();
            $table->string('icon')->default('bi-lightbulb-fill');
            $table->string('image_path')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_id')->nullable();
            $table->boolean('is_highlighted')->default(false);
            $table->integer('sort_order')->default(0);
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
        Schema::dropIfExists('philosophies');
    }
}
