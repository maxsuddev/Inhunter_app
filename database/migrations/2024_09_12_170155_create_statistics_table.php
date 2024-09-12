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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();

            $table->integer('total_vacancies')->default(0);
            $table->integer('open_count')->default(0);
            $table->integer('working_count')->default(0);
            $table->integer('closed_count')->default(0);
            $table->integer('cancelled_count')->default(0);
            $table->decimal('open_percentage', 5, 2)->default(0);
            $table->decimal('working_percentage', 5, 2)->default(0);
            $table->decimal('closed_percentage', 5, 2)->default(0);
            $table->decimal('cancelled_percentage', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
