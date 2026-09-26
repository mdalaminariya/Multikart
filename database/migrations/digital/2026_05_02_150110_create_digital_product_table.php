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
    Schema::create('digital_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('digital_subcategories')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('title');
            $table->text('brand')->nullable();
            $table->string('product_code')->unique();
            $table->decimal('Original_price', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->string('colors')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('size')->nullable();

            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_products');
    }
};
