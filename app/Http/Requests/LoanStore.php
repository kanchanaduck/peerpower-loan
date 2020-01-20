<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoanStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'loan_amount' => 'required|integer|min:1000|max:100000000',
            'loan_term' => 'required|integer|min:1|max:50',
            'interest_rate' => 'required|min:1|max:36|regex:/^\d+(\.\d{1,2})?$/',
            'start_date' => 'required',
            // 'start_date' => 'required|date|after:2017-01-01|before:2050-12-31',
            // 'start_date' => 'required|date|date_format:Y-m|min:2017-01|max:2050-12'
            // 'start_date' => 'required|date|date_format:Y-m'
        ];
    }
}
