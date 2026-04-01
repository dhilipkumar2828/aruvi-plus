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
        // 1. Recreate the coupon_product pivot table for definition
        Schema::create('coupon_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // 2. Create coupon_usage_items pivot table for history
        Schema::create('coupon_usage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_usage_id')->constrained('coupon_usages')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // 3. Remove the JSON columns
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('product_ids');
        });

        Schema::table('coupon_usages', function (Blueprint $table) {
            $table->dropColumn('product_ids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupon_usages', function (Blueprint $table) {
            $table->text('product_ids')->nullable()->after('order_id');
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->text('product_ids')->nullable()->after('description');
        });

        Schema::dropIfExists('coupon_usage_items');
        Schema::dropIfExists('coupon_product');
    }
};
