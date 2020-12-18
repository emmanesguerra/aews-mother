<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('nick_name', 100);
            $table->string('contact_number', 20)->nullable();
            $table->string('contact_address', 500)->nullable();
            $table->string('barangay', 50)->nullable();
            $table->string('landmark', 150)->nullable();
            $table->string('longitude', 11)->nullable();
            $table->string('latitude', 11)->nullable();
            $table->float('current_balance')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
