<?php

use App\Models\Post;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content',);
            $table->text('semiContent');
            $table->json('tags')->nullable();
            $table->string('imageIndex');
            $table->string('categoryType');
            $table->string('video');
            $table->string('audio');
            $table->integer('view_count');
            $table->enum('status', Post::STATUS)->default(Post::STATUS_ACTIVE);
            $table->enum('privacy', Post::PRIVACY)->default(Post::PRIVACY_PUBLIC);
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
        Schema::dropIfExists('posts');
    }
};
