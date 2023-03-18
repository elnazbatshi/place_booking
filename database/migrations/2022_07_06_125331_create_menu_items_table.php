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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')
                  ->constrained('menus')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('title');
            $table->integer('index');
            $table->foreignId('parent_id')
                  ->nullable()
                  ->references('id')
                  ->on('menu_items')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->string('link');
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('menu_items');
    }
};
