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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreignId('menu_id')->references('id')->on('menu')->onDelete('cascade');
            $table->enum('type', ['pickup', 'delivery'])->nullable();
            $table->enum('status', ['finish', 'in_kitchen', 'reject'])->nullable();
            $table->float('total_price')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('street_name', 100)->nullable();
            $table->string('house_no', 100)->nullable();
            $table->string('apartment_no', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
