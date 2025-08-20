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
        Schema::create('quote_reactions', function (Blueprint $table) {
            $table->id();
            $table->enum('reaction_type', ['like', 'dislike']);
            $table->timestamps();

            $table->foreignId('quote_id')->constrained('quotes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->unique(['quote_id', 'user_id']); // 'unique_quote_reaction_per_user'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_reactions');
    }
};
