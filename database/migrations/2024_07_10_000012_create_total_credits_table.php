<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalCreditsTable extends Migration
{
    public function up()
    {
        Schema::create('total_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stripe_transaction')->unique();
            $table->integer('point')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
