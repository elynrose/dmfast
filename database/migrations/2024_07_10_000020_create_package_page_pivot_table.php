<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('package_page', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id', 'page_id_fk_9935526')->references('id')->on('pages')->onDelete('cascade');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_id_fk_9935526')->references('id')->on('packages')->onDelete('cascade');
        });
    }
}
