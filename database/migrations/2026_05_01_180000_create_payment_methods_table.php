<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('payment_methods')) {
            Schema::create('payment_methods', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->nullable();
                $table->decimal('minimum', 24, 8)->default(0);
                $table->decimal('maximum', 24, 8)->default(0);
                $table->decimal('charges_amount', 24, 8)->default(0);
                $table->string('charges_type')->default('fixed');
                $table->text('duration')->nullable();
                $table->string('methodtype')->default('currency');
                $table->longText('img_url')->nullable();
                $table->string('bankname')->nullable();
                $table->string('account_name')->nullable();
                $table->string('account_number')->nullable();
                $table->string('swift_code')->nullable();
                $table->text('wallet_address')->nullable();
                $table->string('barcode')->nullable();
                $table->string('network')->nullable();
                $table->string('type')->default('both');
                $table->string('status')->default('enabled');
                $table->string('defaultpay')->default('no');
                $table->timestamps();
            });
        }

        if (Schema::hasTable('wdmethods')) {
            $wdColumns = Schema::getColumnListing('wdmethods');
            $paymentColumns = Schema::getColumnListing('payment_methods');
            $sharedColumns = array_values(array_intersect($paymentColumns, $wdColumns));

            $rows = DB::table('wdmethods')->get();

            foreach ($rows as $row) {
                $payload = [];

                foreach ($sharedColumns as $column) {
                    $payload[$column] = $row->{$column};
                }

                $payload['slug'] = $payload['slug'] ?? \Illuminate\Support\Str::slug($row->name ?? uniqid('payment-method-'));
                $payload['type'] = $payload['type'] ?? 'both';
                $payload['status'] = $payload['status'] ?? 'enabled';
                $payload['defaultpay'] = $payload['defaultpay'] ?? 'no';
                $payload['charges_type'] = $payload['charges_type'] ?? 'fixed';
                $payload['methodtype'] = $payload['methodtype'] ?? 'currency';
                $payload['created_at'] = $row->created_at ?? now();
                $payload['updated_at'] = $row->updated_at ?? now();
                $payload['img_url'] = $row->img ?? null;

                DB::table('payment_methods')->updateOrInsert(
                    ['name' => $row->name],
                    $payload
                );
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
