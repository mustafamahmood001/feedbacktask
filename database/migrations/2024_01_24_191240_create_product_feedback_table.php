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
        Schema::create('product_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->text('feed_back'); // Assuming feedback can be longer, using text instead of string
            $table->string('feature_request');
            $table->integer('vote_count')->nullable()->default(0); // Default to 0 votes
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('user_id'); // Foreign key to reference the user
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_feedback');
    }
};
