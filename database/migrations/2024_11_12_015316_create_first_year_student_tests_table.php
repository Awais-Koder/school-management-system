<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('first_years', function (Blueprint $table) {
            $table->unique('roll_no');
        });
        Schema::create('first_year_student_tests', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->foreign('roll_number')->references('roll_no')->on('first_years')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('first_year_tests');
            // $table->string('roll_number')->nullable();
            $table->string('marks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_year_student_tests');
    }
};
