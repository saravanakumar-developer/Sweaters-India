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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phonenumber',100)->nullable();
            $table->string('file',100)->nullable();
            $table->string('skills',100)->nullable();
            $table->string('experience',100)->nullable();
            $table->string('comment',100)->nullable();
            $table->string('agree',100)->nullable();
            $table->string('status',100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
