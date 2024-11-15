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
        Schema::create('academic_program_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_level_id')
                ->nullable()
                ->constrained('academic_levels')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('academic_program_id')
                ->nullable()
                ->constrained('academic_programs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_program_levels');
    }
};