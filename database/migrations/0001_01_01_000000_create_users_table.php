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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->string('conta',255)->unique();
            $table->decimal('carteira',10, 2)->default(0.00);
            $table->decimal('food',10, 2)->default(0.00);
            $table->decimal('meal',10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
