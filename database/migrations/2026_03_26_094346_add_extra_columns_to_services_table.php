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
    Schema::table('services', function (Blueprint $table) {
        $table->string('form_title')->nullable()->after('name');
        $table->json('fields')->nullable()->after('description');
        $table->json('required_documents')->nullable()->after('fields');
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn(['form_title', 'fields', 'required_documents']);
    });
}
};
