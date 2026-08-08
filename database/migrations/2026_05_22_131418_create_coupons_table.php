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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('title');
            $table->string('code')->unique();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('free_shipping')->default(false);

            $table->integer('quantity')->nullable();

            $table->enum('discount_type', ['percent', 'fixed'])->nullable();

            $table->decimal('discount', 10, 2)->nullable();

            $table->enum('status', ['success', 'pending', 'waiting'])->default('waiting');

            // Restriction
            $table->string('products')->nullable();

           $table->unsignedBigInteger('category_id')->nullable();
           $table->string('category_type')->nullable();

            $table->decimal('min_spend', 10, 2)->nullable();

            $table->decimal('max_spend', 10, 2)->nullable();

            // Usage
            $table->integer('per_limit')->nullable();

            $table->integer('per_customer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
