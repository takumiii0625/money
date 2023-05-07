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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //★追記
            //  $table->unsignedBigInteger('cost_id'); //★追記
            $table->string('item_name', 100); //★追記
            //  $table->string('photo_path'); //★追記
            //参考リンク: Laravel Documentation - File Storage
            //画像のリサイズや最適化を行いたい場合は、Intervention Image
            $table->integer('seal_price');
            $table->string('photo', 100); //★追記
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
