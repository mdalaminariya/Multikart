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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('desktop_notifications')->default(true);
            $table->boolean('notifications')->default(true);
            $table->boolean('own_activity_notifications')->default(false);
            $table->boolean('dnd')->default(false);

            $table->boolean('is_deactivated')->default(false);
            $table->string('deactivation_reason')->nullable();

            $table->string('deletion_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'desktop_notifications',
                'notifications',
                'own_activity_notifications',
                'dnd',
                'is_deactivated',
                'deactivation_reason',
                'deletion_reason',
            ]);
        });
    }
};
