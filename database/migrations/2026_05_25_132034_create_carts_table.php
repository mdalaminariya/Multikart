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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('product_id');
            $table->enum('product_type', ['physical', 'digital']);
            $table->decimal('price', 10, 2);

            $table->integer('quantity')->default(1);

            $table->timestamps();

            $table->unique(['user_id', 'product_id', 'product_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
