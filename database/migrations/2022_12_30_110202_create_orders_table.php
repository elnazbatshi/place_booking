<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('location_infos')
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('customers');
            $table->date('day');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('index');
            $table->string('subject');
            $table->string('department');
            $table->boolean('parking');
            $table->boolean('catering');
            $table->string('desc')->nullable();
            $table->string('form_data')->nullable();
            $table->enum('status', Order::STATUS)->default(Order::STATUS_PENDING);
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
        Schema::dropIfExists('orders');
    }
};
