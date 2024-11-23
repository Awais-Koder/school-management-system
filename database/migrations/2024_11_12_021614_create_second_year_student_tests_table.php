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
        Schema::table('second_years', function (Blueprint $table) {
            $table->unique('roll_no');
        });
        Schema::create('second_year_student_tests', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->foreign('roll_number')->references('roll_no')->on('second_years')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('second_year_tests');
            $table->string('marks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('second_years', function (Blueprint $table) {
            $table->dropUnique('roll_no');
        });
        Schema::dropIfExists('second_year_student_tests');
    }
};
