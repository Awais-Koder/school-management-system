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
        Schema::create('bs_one_student_tests', function (Blueprint $table) {
            $table->id();
            $table->string('roll_number');
            $table->foreign('roll_number')->references('roll_no')->on('bs_ones')->onDelete('cascade');
            $table->foreignId('test_id')->constrained('bs_third_tests');
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
        Schema::dropIfExists('bs_one_student_tests');
    }
};
