
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Submitted values for each dynamic field  {index: value}
            $table->json('field_data')->nullable();

            // Uploaded document paths  {index: {name, doctype, path}}
            $table->json('documents')->nullable();

            $table->string('status')->default('pending'); // pending|processing|completed|rejected

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_applications');
    }
};

