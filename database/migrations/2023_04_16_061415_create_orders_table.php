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
            $table->unsignedBigInteger('id_categories')->nullable();
            $table->foreign('id_categories')->references('id')->on('categories');
            $table->string('cashier')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('customer')->nullable();
            $table->double('total');
            $table->double('paid');
            $table->double('return');
            $table->string('proof_of_payment');
            $table->date('deleted_at')->nullable();
            $table->date('date_order')->nullable();
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
