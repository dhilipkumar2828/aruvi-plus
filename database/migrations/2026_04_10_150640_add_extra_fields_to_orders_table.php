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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('taxable_value', 10, 2)->default(0)->after('amount');
            $table->decimal('gst_amount', 10, 2)->default(0)->after('taxable_value');
            $table->decimal('gst_rate', 5, 2)->default(18)->after('gst_amount');
            $table->string('payment_method')->default('ONLINE')->after('payment_status');
            $table->string('transaction_id')->nullable()->after('payment_method');
            $table->string('gateway_order_id')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'taxable_value',
                'gst_amount',
                'gst_rate',
                'payment_method',
                'transaction_id',
                'gateway_order_id'
            ]);
        });
    }
};
