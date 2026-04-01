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
        Schema::create('shipping_infos', function (Blueprint $table) {
            $table->id();
            $table->decimal('from_amount', 10, 2)->default(0);
            $table->decimal('to_amount', 10, 2)->default(0);
            $table->decimal('shipping_charges_tn_py', 10, 2)->default(0);
            $table->decimal('discount_tn_py', 10, 2)->default(0);
            $table->decimal('shipping_charges_other', 10, 2)->default(0);
            $table->decimal('discount_other', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_infos');
    }
};
