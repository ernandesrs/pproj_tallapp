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
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('name');
            $table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->string('username', 25)->unique();
            $table->string('avatar')->nullable();
            $table->string('gender')->default('n');

            $table->fullText(['first_name', 'last_name', 'username', 'email']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('name');
            $table->dropColumn(['first_name', 'last_name', 'username', 'gender', 'avatar']);
            $table->dropFullText(['first_name', 'last_name', 'username', 'email']);

        });
    }
};
