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
        Schema::create('h_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')
                ->constrained('users', 'id');
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients', 'id')
                ->nullOnDelete();
            $table->enum('type', ['buying', 'sale'])->default('buying');
            $table->unsignedFloat('total');
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
        Schema::dropIfExists('h_receipts');
    }
};
