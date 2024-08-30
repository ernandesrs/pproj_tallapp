<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {

            $table->string('display_name', 25);
            $table->boolean('protected')->default(false)->comment('Apenas cargos do sistema serão protegidos.');
            $table->text('description')->nullable();
            $table->fullText(['name', 'display_name']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {

            $table->dropColumn(['display_name', 'protected', 'description']);
            $table->dropFullText(['name', 'display_name']);

        });
    }
};
