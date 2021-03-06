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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('slug')->unique();
            $table->string('status')->nullable();
            $table->foreignId('venue_id');
            $table->foreignId('artist_id');
            $table->foreignId('genre_id');
            $table->dateTime('start_date');
            $table->dateTime('end_time')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('upvotes')->default(0);

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
        Schema::dropIfExists('events');
    }
};
