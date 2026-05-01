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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pair');
            $table->string('type'); // Buy, Sell
            $table->string('market_type'); // Spot, Future
            $table->double('amount', 25, 8);
            $table->double('price', 25, 8);
            $table->double('leverage', 5, 2)->default(1);
            $table->string('status')->default('Open'); // Open, Closed, Canceled
            $table->double('pnl', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
