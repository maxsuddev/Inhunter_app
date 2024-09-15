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
        Schema::create('candidate_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('total_count')->default(0);
            $table->integer('new_count')->default(0);
            $table->integer('working_count')->default(0);
            $table->integer('archive_count')->default(0);
            $table->integer('interview_count')->default(0);
            $table->integer('hired_count')->default(0);
            $table->decimal('new_percentage', 5, 2)->default(0);
            $table->decimal('working_percentage', 5, 2)->default(0);
            $table->decimal('archive_percentage', 5, 2)->default(0);
            $table->decimal('interview_percentage', 5, 2)->default(0);
            $table->decimal('hired_percentage', 5, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_statistics');
    }
};
