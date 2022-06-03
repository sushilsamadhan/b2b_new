<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(true);
            $table->string('type', 100)->nullable(true);
            $table->string('rating')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->string('image', 255)->nullable(true);
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
}
