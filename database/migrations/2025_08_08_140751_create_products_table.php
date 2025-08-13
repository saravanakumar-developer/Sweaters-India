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
            $table->date('date')->nullable();
            $table->string('category',100)->nullable();
            $table->string('productName',100)->nullable();
            $table->string('price',100)->nullable();
            $table->string('brand',100)->nullable();
            $table->string('style_no',100)->nullable();
            $table->string('gauge',100)->nullable();
            $table->string('count',100)->nullable();
            $table->string('construction',100)->nullable();
            $table->string('fabric',100)->nullable();
            $table->string('image',100)->nullable();
            $table->integer('status')->nullable();
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
