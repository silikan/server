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
        Schema::create('category_gig', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gig_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')  ->onDelete('cascade');
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
        Schema::dropIfExists('category_gig');
    }
};
