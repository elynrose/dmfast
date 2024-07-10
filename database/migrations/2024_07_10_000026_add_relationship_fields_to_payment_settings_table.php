<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('payment_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9935749')->references('id')->on('users');
            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id', 'method_fk_9935750')->references('id')->on('payment_methods');
        });
    }
}
