<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id'); // この行を追加

            $table->unsignedBigInteger('user_id'); //★追記
            $table->string('others_cost', 100);
            $table->string('send_cost', 100);
            $table->string('original_cost', 100);

            $table->string('item_name', 100);
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            // 外部キー制約を追加
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
