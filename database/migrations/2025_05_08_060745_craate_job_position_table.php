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
        Schema::create('job_position', function (Blueprint $table) {
            $table->id();
            $table->string('job_position')->unique(); //ตำแหน่งงาน
            $table->integer('status_position'); //สถานะตำแหน่งงาน เช่น 1 = รายวัน, 2 = ราชการ, 3 = กระทรวง
            $table->timestamps();
        });
    }

    /**s
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
