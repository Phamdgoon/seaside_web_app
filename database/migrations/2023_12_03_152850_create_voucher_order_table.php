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
        Schema::create('voucher_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->string('voucher_code')->nullable();
            $table->timestamps();

            $table->unique(['id_order', 'voucher_code']);
            
            $table->foreign('id_order')
            ->references('id')->on('order')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('voucher_code')
            ->references('code')->on('voucher')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_order');
    }
};
