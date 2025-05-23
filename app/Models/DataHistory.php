<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHistory extends Model
{
    use HasFactory;

    protected $table = 'data_history';

    protected $fillable = [
        'name_id',
        'tb_national_id',
        'date',
        'status_id',
        'leave_days',
        'net_salary',
        'arrears_salary',
        'lump_sum_payment',
        'lump_sum_payment_m',
        'arrears_lump_sum',
        'public_health_special_allowance',
        'arrears_public_health_special_allowance',
        'temporary_cost_of_living',
        'salary_refund',
        'risk_compensation',
        'tax_rate',
        'social_security_deduction',
        'coop_contribution',
        'funeral_fund',
        'salary',
        'coop_special',
        'cleaning_fee',
        'water_bill',
        'electricity_bill',
        'gsb_maejo',
        'refund_form_11',
        'gsb_meechok',
        'student_loan_repayment',
    ];
}
