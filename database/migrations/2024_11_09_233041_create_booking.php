<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('workspaces_id')->constrained('workspaces')->onDelete('cascade');
            $table->date('date');
            $table->time('hour');
            $table->enum('status', ['Pendiente', 'Aceptada', 'Rechazada'])->default('Pendiente');
            $table->timestamps();
            $table->unique(['workspaces_id', 'date', 'hour']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
