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
        Schema::create('tb_users', function (Blueprint $table) {
        $table->id();
        $table->string('tb_username');  //ไม่น่าจะได้ใช้
        $table->string('tb_password'); //รหัสผ่าน
        $table->string('tb_email')->unique(); //อีเมล์
        $table->string('tb_firstname');  //ชื่อ
        $table->string('tb_lastname');   //นามสกุล
        $table->string('tb_national_id', 13)->unique(); // จำกัดความยาว และต้องไม่ซ้ำ
        $table->string('tb_bank_account_number', 20)->nullable(); //เลขบัญชี
        $table->string('tb_bank_name')->nullable(); //ชื่อธนาคาร
        $table->string('tb_job_group');        // กลุ่มงาน  
        $table->string('tb_department');      // ฝ่าย/แผนก  
        $table->string('tb_division');        // หน่วยงาน  
        $table->string('tb_position');        // ตำแหน่ง  
        $table->string('tb_level');           // ระดับ  
        $table->string('tb_personnel_type'); // ประเภทบุคคลากร
        $table->enum('tb_status', ['0', '1'])->comment('0 = ไม่ทำงาน, 1 = ทำงาน'); //สถานะทำงาน
        $table->enum('tb_user_role', ['1', '2', '3'])->default('1')->comment('1 = client, 2 = admin, 3 = superadmin'); // สิทธิ์ผู้ใช้
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
