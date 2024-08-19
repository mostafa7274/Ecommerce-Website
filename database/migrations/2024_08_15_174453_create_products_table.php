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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seller_id')->unsigned()->index()->nullable();
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->string('name');
            $table->longText('description');
            $table->decimal('price', 8, 2); // Price of the product (up to 999,999.99)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('image')->nullable(); // Column for the product image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
