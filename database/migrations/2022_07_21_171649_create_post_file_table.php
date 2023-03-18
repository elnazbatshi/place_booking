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
        Schema::create('post_file', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('file_id')->references('id')->on('files')
                  ->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('post_file');
    }
};
