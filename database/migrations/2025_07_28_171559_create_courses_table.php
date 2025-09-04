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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['kepaskibraan', 'baris_berbaris', 'wawasan', 'kepemimpinan', 'protokoler']);
            $table->enum('difficulty', ['basic', 'intermediate', 'advanced'])->default('basic');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('duration_minutes')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
