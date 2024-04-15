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
        //

        Schema::create('student_reports', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('student_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('class')->nullable();
            $table->string('email')->nullable();
            $table->string('scores');
            $table->float('total_marks');
            $table->float('percentage')->nullable();
            $table->string('grade')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('student_reports');
    }
};
