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
        Schema::create('debentures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('clients', 'id');
            $table->foreignId('user_id')
                ->constrained('users', 'id');
            $table->unsignedFloat('amount');
            $table->enum('type', ['catch', 'receive'])->default('catch');
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
        Schema::dropIfExists('debentures');
    }
};
