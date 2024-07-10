<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodWithdrawPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_method_withdraw', function (Blueprint $table) {
            $table->unsignedBigInteger('withdraw_id');
            $table->foreign('withdraw_id', 'withdraw_id_fk_9935545')->references('id')->on('withdraws')->onDelete('cascade');
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id', 'payment_method_id_fk_9935545')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }
}
