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
        Schema::create('paskibra_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jabatan', 50)->nullable();
            $table->string('periode', 20)->nullable();
            $table->string('sekolah', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('parent_contact', 15)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 50)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('emergency_contact', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paskibra_profiles');
    }
};
