<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role_id as a foreign key after join_date
            $table->foreignId('role_id')
                  ->nullable()
                  ->after('join_date')
                  ->constrained('roles')
                  ->cascadeOnDelete();

            // Drop old string 'role' column
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore old 'role' string column after join_date
            $table->string('role')->after('join_date')->nullable();

            // Drop role_id column and its foreign key
            $table->dropConstrainedForeignId('role_id');
        });
    }
};