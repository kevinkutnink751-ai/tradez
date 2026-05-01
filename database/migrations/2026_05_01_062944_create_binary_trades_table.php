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
        Schema::create('binary_trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('coin_pair');
            $table->double('amount', 15, 2);
            $table->double('win_amount', 15, 2)->default(0);
            $table->string('direction'); // Higher/Lower
            $table->integer('duration'); // in seconds
            $table->string('status')->default('Open'); // Open, Closed
            $table->string('result')->default('Pending'); // Win, Loss, Draw, Pending
            $table->double('strike_price', 25, 8);
            $table->double('end_price', 25, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binary_trades');
    }
};
