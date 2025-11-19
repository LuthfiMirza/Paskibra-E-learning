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
        if (!Schema::hasColumn('users', 'learning_level')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('learning_level', [
                    'umum',
                    'calon_paskibra',
                    'wiramuda',
                    'wiratama',
                    'instruktur_muda',
                    'instruktur',
                ])->default('umum')->after('angkatan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'learning_level')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('learning_level');
            });
        }
    }
};
