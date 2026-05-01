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
        Schema::create('mt4_transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mt4_details_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->string('action'); // CREATED, APPROVED, REJECTED, etc.
            $table->string('before_status')->nullable();
            $table->string('after_status')->nullable();
            $table->json('details')->nullable();
            $table->json('api_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt4_transaction_logs');
    }
};
