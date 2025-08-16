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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // Link to the users table
            // A user can have many products in their wishlist
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Link to the products table
            // A product can be in many users' wishlists
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // To prevent duplicate entries (e.g., a user adding the same product twice)
            $table->unique(['user_id', 'product_id']);

            // Timestamps to track when the product was added to the wishlist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
