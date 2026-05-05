<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('location')->nullable();

            // settings
            $table->boolean('allow_notifications')->default(0);
            $table->boolean('enable_notifications')->default(0);
            $table->boolean('own_activity_notification')->default(0);
            $table->boolean('dnd')->default(0);

            // social
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('twitter_id')->nullable();

            //employee status
            $table->integer('performance')->default(0);
            $table->integer('overtime')->default(0);
            $table->integer('leaves_taken')->default(0);


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_settings');
    }
};
