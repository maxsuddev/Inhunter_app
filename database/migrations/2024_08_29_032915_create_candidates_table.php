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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id');
            $table->text('full_name')->nullable();
            $table->string('phone_number',30)->nullable();
            $table->date('birthday')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender',['man','woman'])->nullable();
            $table->enum('is_student',['0','1'])->default('0');
            $table->text('university_place')->nullable();
            $table->enum('marital_state',['married','no_married','divorce','widow'])->nullable();
            $table->text('last_work')->nullable();
            $table->string('languages')->nullable();
            $table->string('voice_path')->nullable();
            $table->text('positive_skills')->nullable();
            $table->string('apps')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
