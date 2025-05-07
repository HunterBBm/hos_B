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
        Schema::create('users_history', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('date');
            $table->unsignedTinyInteger('status_id')->default(1); //primarykey สำหรับเชื่อมกับตำแหน่งงาน
            $table->unsignedTinyInteger('leave_days')->default(0); //จำนวนวันหยุด
            $table->decimal('net_salary', 10, 2)->default(0.00); //เงินเดือน
            $table->decimal('arrears_salary', 10, 2)->default(0.00); //ตกเบิกเงินเดือน
            $table->decimal('lump_sum_payment', 10, 2)->default(0.00); //เหมาจ่าย
            $table->decimal('lump_sum_payment_m', 10, 2)->default(0.00); //เหมาจ่าย ตค.66
            $table->decimal('arrears_lump_sum', 10, 2)->default(0.00); //ตกเบิกเหมาจ่าย
            $table->decimal('public_health_special_allowance', 10, 2)->default(0.00); //พตส.เดือน พย.66
            $table->decimal('arrears_public_health_special_allowance', 10, 2)->default(0.00); //ตกเบิก พตส.
            $table->decimal('temporary_cost_of_living', 10, 2)->default(0.00); //ค่าครองชีพชั่วคราว
            $table->decimal('salary_refund', 10, 2)->default(0.00); //รับคืนเงินเดือน
            $table->decimal('risk_compensation', 10, 2)->default(0.00); //เสี่ยงภัย

            $table->decimal('tax_rate', 5, 2)->default(0.00); //หักภาษี
            $table->decimal('social_security_deduction', 10, 2)->default(0.00); //ประกันสังคม
            $table->decimal('coop_contribution', 10, 2)->default(0.00); //สหกรณ์(สมทบ)
            $table->decimal('funeral_fund', 10, 2)->default(0.00); //ฌาปนกิจสงเคราะห์ (ฌกส.)
            $table->decimal('salary', 10, 2)->default(0.00); //กองทุนสำรองเลี้ยงชีพ
            $table->decimal('coop_special', 10, 2)->default(0.00); //สหกรณ์(พิเศษ)
            $table->decimal('cleaning_fee', 10, 2)->default(0.00); //ค่าทำความสะอาด
            $table->decimal('water_bill', 10, 2)->default(0.00); //ค่าน้ำ
            $table->decimal('electricity_bill', 10, 2)->default(0.00); //ค่าไฟ
            $table->decimal('gsb_maejo', 10, 2)->default(0.00); //ออมสินแม่โจ้
            $table->decimal('refund_form_11', 10, 2)->default(0.00); //คืนเงิน ฉ.11
            $table->decimal('gsb_meechok', 10, 2)->default(0.00); //ออมสินมีโชค
            $table->decimal('student_loan_repayment', 10, 2)->default(0.00); //เงินกู้กยศ.

            $table->decimal('gross_salary', 10, 2);  //เงินเดือนรวม
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
