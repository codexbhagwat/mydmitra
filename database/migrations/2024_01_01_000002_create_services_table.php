<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('form_title')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('icon')->default('bi-gear');
            $table->boolean('is_active')->default(true);

            // JSON columns — store dynamic fields & document specs
            // Cast to 'array' in the Model so they arrive as PHP arrays
            $table->json('fields')->nullable();               // application form fields
            $table->json('required_documents')->nullable();   // documents user must upload

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
