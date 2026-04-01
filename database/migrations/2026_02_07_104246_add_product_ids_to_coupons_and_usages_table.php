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
        Schema::table('coupons', function (Blueprint $table) {
            $table->text('product_ids')->nullable()->after('description');
        });

        Schema::table('coupon_usages', function (Blueprint $table) {
            $table->text('product_ids')->nullable()->after('order_id');
        });

        // Drop the pivot table as requested
        Schema::dropIfExists('coupon_product');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('coupon_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('coupon_usages', function (Blueprint $table) {
            $table->dropColumn('product_ids');
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('product_ids');
        });
    }
};
