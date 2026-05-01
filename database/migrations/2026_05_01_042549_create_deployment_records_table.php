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
        Schema::create('deployment_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mt4_details_id')->index();
            $table->string('type'); // DEPLOY, UNDEPLOY
            $table->string('status'); // SUCCESS, FAILED
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deployment_records');
    }
};
