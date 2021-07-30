<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('amount', 5, 2);
            //$table->foreignId('to')->constrained('accounts');
            //$table->foreignId('from')->constrained('accounts');
            $table->string('toiban', 22);
            $table->string('fromiban', 22);
            $table->string('purpose', 500)->nullable();
            $table->dateTime('time');
            $table->string('currency', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
