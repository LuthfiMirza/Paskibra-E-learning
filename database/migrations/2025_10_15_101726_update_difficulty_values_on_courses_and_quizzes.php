<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        $expandedEnum = "ENUM('basic','intermediate','advanced','umum','calon_paskibra','wiramuda','wiratama','instruktur_muda','instruktur')";
        $finalEnum = "ENUM('umum','calon_paskibra','wiramuda','wiratama','instruktur_muda','instruktur')";

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE courses MODIFY difficulty {$expandedEnum} NOT NULL DEFAULT 'basic'");
            DB::statement("ALTER TABLE quizzes MODIFY difficulty {$expandedEnum} NOT NULL DEFAULT 'basic'");
        }

        DB::statement("UPDATE courses SET difficulty = 'umum' WHERE difficulty IN ('basic', '', ' ') OR difficulty IS NULL");
        DB::statement("UPDATE courses SET difficulty = 'wiramuda' WHERE difficulty = 'intermediate'");
        DB::statement("UPDATE courses SET difficulty = 'instruktur' WHERE difficulty = 'advanced'");
        DB::statement("UPDATE courses SET difficulty = 'umum' WHERE difficulty NOT IN ('umum','calon_paskibra','wiramuda','wiratama','instruktur_muda','instruktur')");

        DB::statement("UPDATE quizzes SET difficulty = 'umum' WHERE difficulty IN ('basic', '', ' ') OR difficulty IS NULL");
        DB::statement("UPDATE quizzes SET difficulty = 'wiramuda' WHERE difficulty = 'intermediate'");
        DB::statement("UPDATE quizzes SET difficulty = 'instruktur' WHERE difficulty = 'advanced'");
        DB::statement("UPDATE quizzes SET difficulty = 'umum' WHERE difficulty NOT IN ('umum','calon_paskibra','wiramuda','wiratama','instruktur_muda','instruktur')");

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE courses MODIFY difficulty {$finalEnum} NOT NULL DEFAULT 'umum'");
            DB::statement("ALTER TABLE quizzes MODIFY difficulty {$finalEnum} NOT NULL DEFAULT 'umum'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        $expandedEnum = "ENUM('basic','intermediate','advanced','umum','calon_paskibra','wiramuda','wiratama','instruktur_muda','instruktur')";
        $originalEnum = "ENUM('basic','intermediate','advanced')";

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE courses MODIFY difficulty {$expandedEnum} NOT NULL DEFAULT 'basic'");
            DB::statement("ALTER TABLE quizzes MODIFY difficulty {$expandedEnum} NOT NULL DEFAULT 'basic'");
        }

        DB::statement("UPDATE courses SET difficulty = 'basic' WHERE difficulty = 'umum'");
        DB::statement("UPDATE courses SET difficulty = 'intermediate' WHERE difficulty IN ('calon_paskibra','wiramuda')");
        DB::statement("UPDATE courses SET difficulty = 'advanced' WHERE difficulty IN ('wiratama','instruktur_muda','instruktur')");
        DB::statement("UPDATE courses SET difficulty = 'basic' WHERE difficulty NOT IN ('basic','intermediate','advanced')");

        DB::statement("UPDATE quizzes SET difficulty = 'basic' WHERE difficulty = 'umum'");
        DB::statement("UPDATE quizzes SET difficulty = 'intermediate' WHERE difficulty IN ('calon_paskibra','wiramuda')");
        DB::statement("UPDATE quizzes SET difficulty = 'advanced' WHERE difficulty IN ('wiratama','instruktur_muda','instruktur')");
        DB::statement("UPDATE quizzes SET difficulty = 'basic' WHERE difficulty NOT IN ('basic','intermediate','advanced')");

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE courses MODIFY difficulty {$originalEnum} NOT NULL DEFAULT 'basic'");
            DB::statement("ALTER TABLE quizzes MODIFY difficulty {$originalEnum} NOT NULL DEFAULT 'basic'");
        }
    }
};
