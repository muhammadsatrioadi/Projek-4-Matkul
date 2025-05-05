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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mcu_registration_id')->constrained()->onDelete('cascade');
            $table->string('record_number')->unique();
            $table->date('examination_date');
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('doctor_notes')->nullable();
            $table->json('lab_results')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
}; 