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
            $table->string('coupon_code')->nullable()->after('payment_status');
            $table->string('coupon_type', 20)->nullable()->after('coupon_code');
            $table->decimal('coupon_value', 10, 2)->nullable()->after('coupon_type');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('coupon_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'coupon_code',
                'coupon_type',
                'coupon_value',
                'discount_amount',
            ]);
        });
    }
};
