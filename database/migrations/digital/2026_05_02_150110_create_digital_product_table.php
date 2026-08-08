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

        // Subcategory relation
        $table->foreignId('subcategory_id')->constrained('digital_subcategories')->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

        // Basic product info
        $table->string('title');
        $table->string('sku')->unique();
        $table->text('short_summary')->nullable();
        $table->longText('description')->nullable();
        $table->string('images')->nullable();
        $table->decimal('price', 10, 2);
        $table->integer('quantity')->default(1);
        $table->text('sizes')->nullable();
        $table->enum('status',['enable','disable'])->default('disable');
        $table->text('colors')->nullable();

        // SEO fields
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
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
