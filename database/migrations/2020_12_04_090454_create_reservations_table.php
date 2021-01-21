<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->addColumn('datetime', 'created_at')->default(date(('Y-m-d H:i:s')));
            $table->addColumn('date','date_arrival');
            $table->addColumn('date','date_leave')->nullable();
            $table->addColumn('integer','number_guests')->nullable();
            $table->addColumn('text','phone')->nullable();
            $table->addColumn('text','name')->nullable();
            $table->addColumn('text','email')->nullable();
            $table->addColumn('text','message')->nullable();
            $table->addColumn('integer', 'status')->default(1);
            $table->addColumn('bigInteger', 'room_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
