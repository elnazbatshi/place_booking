<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tag');
            $table->string('imageIndex');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('categories')
                  ->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('subject_categories');
    }
};
