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
        Schema::create('status_salary', function (Blueprint $table) {
            $table->id();
            $table->decimal('job_salary', 10, 2)->default(0.00)->unique();  //ค่าตอบแทน เป็นจำนวนเต็ม ไม่เอาทศนิยม
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
