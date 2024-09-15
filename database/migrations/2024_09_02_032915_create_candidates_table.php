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
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
            $table->foreignId('app_id')->constrained('apps')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');


            $table->enum('status', ['new', 'interview', 'archive', 'working', 'hired'])->default('new');
            $table->bigInteger('telegram_id')->nullable();
            $table->text('full_name')->nullable();
            $table->string('phone_number',30)->nullable();
            $table->date('birthday')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender',['man','woman'])->nullable();
            $table->enum('is_student',['0','1'])->default('0');
            $table->text('university_place')->nullable();
            $table->enum('marital_state',['married','no_married','divorce','widow'])->nullable();
            $table->text('last_work')->nullable();
            $table->string('voice_path')->nullable();
            $table->text('positive_skills')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
