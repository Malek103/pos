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
        Schema::table('h_receipts', function (Blueprint $table) {
            //
            $table->enum('status', ['notdeleted', 'deleted'])->default('notdeleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('h_receipts', function (Blueprint $table) {
            //
        });
    }
};
