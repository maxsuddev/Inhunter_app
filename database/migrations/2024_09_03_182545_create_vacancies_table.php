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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();

            //foreign
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->ondelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->ondelete('cascade');
            $table->foreignId('candidate_id')->nullable()->constrained('candidates')->ondelete('cascade');


            $table->string('name');
            $table->enum('state', ['open_vacancy', 'working_vacancy','close_vacancy', 'cancel_vacancy'])->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
