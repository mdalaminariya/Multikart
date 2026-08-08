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
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // Parent order
            $table->foreignId('order_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Product information
            $table->unsignedBigInteger('product_id');

            $table->enum('product_type', [
                'physical',
                'digital'
            ]);

            // Snapshot of product data at order time
            $table->string('product_name');
            $table->decimal('price', 10, 2);

            // Quantity
            $table->integer('quantity')->default(1);

            // Total price for this item
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
