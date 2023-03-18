<?php

use App\Models\LocationInfo;
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
        Schema::create('location_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('index');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories')
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('desc');
            $table->json('image')->nullable();
            $table->json('video')->nullable();
            $table->json('files')->nullable();
            $table->enum('status', LocationInfo::STATUS)->default(LocationInfo::STATUS_ACTIVE);
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
        Schema::dropIfExists('location_infos');
    }
};
