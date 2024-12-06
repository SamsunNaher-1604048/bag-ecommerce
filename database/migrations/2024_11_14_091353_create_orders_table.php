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
            $table->string('user_ip',20);
            $table->unsignedBigInteger('user_id');
            $table->string('name',50);
            $table->string('email',20);
            $table->string('phone',20);
            $table->integer('shipping_id');
            $table->string('code');
            $table->string('city',50);
            $table->string('address',200);
            $table->string('comment',200);
            $table->integer('payment_method');
            $table->string('status','20')->default('pending');
            $table->decimal('sub_total',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('tax',10,2);
            $table->decimal('shipping_price',10,2);
            $table->decimal('grand_total',10,2);
            $table->string('tracking_number',20);
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
