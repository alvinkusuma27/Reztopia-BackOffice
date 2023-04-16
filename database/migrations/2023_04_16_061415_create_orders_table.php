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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_outlet')->nullable();
            $table->foreign('id_outlet')->references('id')->on('outlets');
            $table->unsignedBigInteger('id_order_status')->nullable();
            $table->foreign('id_order_status')->references('id')->on('order_status');
            $table->string('cashier')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('customer')->nullable();
            $table->double('total')->default(0);
            $table->double('paid')->default(0);
            $table->double('return')->default(0);
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
