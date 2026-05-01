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
        // 1. Create assets table
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('category')->nullable();
            $table->string('type')->default('Crypto'); // Fiat, Crypto
            $table->string('logo')->nullable();
            $table->boolean('status')->default(true);
            $table->decimal('base_rate', 20, 8)->default(1); // Exchange rate to USD
            $table->timestamps();
        });

        // 2. Create user_wallets table
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->double('spot_bal', 25, 8)->default(0);
            $table->double('funding_bal', 25, 8)->default(0);
            $table->double('future_bal', 25, 8)->default(0);
            $table->double('copy_trade_bal', 25, 8)->default(0);
            $table->timestamps();
            
            // A user can only have one wallet per asset
            $table->unique(['user_id', 'asset_id']);
        });

        // 3. Data Migration
        // First, ensure USD exists in assets
        $usdAsset = \App\Models\Asset::where('symbol', 'USD')->first();
        if (!$usdAsset) {
            $usdAsset = \App\Models\Asset::create([
                'name' => 'United States Dollar',
                'symbol' => 'USD',
                'type' => 'Fiat',
                'category' => 'Fiat',
                'base_rate' => 1
            ]);
        }

        // Migrate users to the USD wallet
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            \Illuminate\Support\Facades\DB::table('user_wallets')->insert([
                'user_id' => $user->id,
                'asset_id' => $usdAsset->id,
                'spot_bal' => $user->spot_bal ?? 0,
                'funding_bal' => $user->funding_bal ?? 0,
                'future_bal' => $user->future_bal ?? 0,
                'copy_trade_bal' => $user->account_bal ?? 0, // Using account_bal as base or copytrade bal
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wallets');
        
        Schema::dropIfExists('assets');
    }
};
