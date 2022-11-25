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
        Schema::create('md_transactions', function (Blueprint $table) {
            $table->string('id_transaction', '10');
            $table->string('id_product', '5');
            $table->string('id_method_of_payment', 6);
            $table->foreignId('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->integer('total_bought');
            $table->timestamps();
        });

        Schema::table('md_transactions', function (Blueprint $table) {
            $table->foreign('id_product')->references('id_product')->on('md_stocks')->restrictOnDelete();
            $table->foreign('id_method_of_payment')->references('id_method_of_payment')->on('md_method_of_payments')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('md_transactions');
    }
};
