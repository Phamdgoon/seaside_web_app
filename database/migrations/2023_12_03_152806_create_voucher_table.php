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
            $table->id();
            $table->string('code')->unique();
            $table->string('name_shop')->nullable();
            $table->integer('discountPercentage')->nullable();
            $table->decimal('discountAmount')->nullable();
            $table->datetime('validFrom');
            $table->datetime('validTo');
            $table->integer('usageLimit');
            $table->boolean('platformVoucher')->default(false);
            $table->timestamps();

            $table->foreign('name_shop')
            ->references('name_shop')->on('shop_profile')->onUpdate('cascade')->onDelete('cascade');
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
