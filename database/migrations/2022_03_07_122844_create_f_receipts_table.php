<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_id')
                ->constrained('h_receipts', 'id');
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products', 'id')
                ->nullOnDelete();
            $table->unsignedFloat('cost')->default(0);
            $table->unsignedFloat('price')->default(0);
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_receipts');
    }
};
