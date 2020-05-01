<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            $table->date('book_date');
            $table->time('book_time');
            $table->unsignedInteger('people_count');
            $table->timestamps();

            $table->foreign('user_id    ')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_user_id_foreign');
            $table->dropForeign('bookings_table_id_foreign');
        });
        Schema::dropIfExists('bookings');
    }
}
