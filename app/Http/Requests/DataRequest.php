<?php

namespace App\Http\Requests;
use Urameshibr\Requests\FormRequest;

class DataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_id' => 'required|string',
            'date' => 'required|date',
            'status_id' => 'required|integer',
            'leave_days' => 'required|integer',
            'net_salary' => 'required|numeric',
            'arrears_salary' => 'required|numeric',
            'lump_sum_payment' => 'required|numeric',
            'lump_sum_payment_m' => 'required|numeric',
            'arrears_lump_sum' => 'required|numeric',
            'public_health_special_allowance' => 'required|numeric',
            'arrears_public_health_special_allowance' => 'required|numeric',
            'temporary_cost_of_living' => 'required|numeric',
            'salary_refund' => 'required|numeric',
            'risk_compensation' => 'required|numeric',
            'tax_rate' => 'required|numeric',
            'social_security_deduction' => 'required|numeric',
            'coop_contribution' => 'required|numeric',
            'funeral_fund' => 'required|numeric',
            'salary' => 'required|numeric',
            'coop_special' => 'required|numeric',
            'cleaning_fee' => 'required|numeric',
            'water_bill' => 'required|numeric',
            'electricity_bill' => 'required|numeric',
            'gsb_maejo' => 'required|numeric',
            'refund_form_11' => 'required|numeric',
            'gsb_meechok' => 'required|numeric',
            'student_loan_repayment' => 'required|numeric',
        ];
    }
}
