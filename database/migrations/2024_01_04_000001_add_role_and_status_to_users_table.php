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
        // Guarded adds to avoid duplicate column errors on re-run
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'instructor', 'student'])->default('student')->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('role');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'role') || Schema::hasColumn('users', 'status')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'role')) {
                    $table->dropColumn('role');
                }
                if (Schema::hasColumn('users', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};
