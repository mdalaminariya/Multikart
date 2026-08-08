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
        Schema::create('menus', function (Blueprint $table) {

            $table->id();

            // Menu Name
            $table->string('name');

            // Auto slug
            $table->string('slug')->nullable();

            // URL / Route
            $table->string('url')->nullable();

            // FontAwesome Icon
            $table->string('icon')->nullable();

            // Parent Menu
            $table->unsignedBigInteger('parent_id')->nullable();

            // Sorting Position
            $table->integer('position')->default(0);

            // Status
            $table->string('status')->default('waiting');

            $table->timestamps();

            // Parent Relationship
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
