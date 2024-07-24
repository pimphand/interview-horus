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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category_vouchers', 'id')->onDelete('cascade');
            $table->string('name', 40)->index('name_index');
            $table->string('photo', 40)->index('photo_index');
            $table->integer('amount')->index('amount_index');
            $table->boolean('status')->default(true)->index('status_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
