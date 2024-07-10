<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('credit_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('credit');
            $table->decimal('amount', 15, 2);
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
