<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('contact_enquiries', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->string('phone', 15);
        $table->string('email', 100)->nullable();
        $table->string('service', 150)->nullable();
        $table->text('message')->nullable();
        $table->timestamps();
    });
}


};
