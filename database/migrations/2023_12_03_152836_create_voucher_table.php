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
        Schema::create('voucher', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('name_shop')->nullable();
            $table->integer('discountPercentage');
            $table->decimal('discountAmount', 10, 2);
            $table->datetime('validFrom');
            $table->datetime('validTo');
            $table->integer('usageLimit');
            $table->boolean('platformVoucher')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
