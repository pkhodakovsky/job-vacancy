<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "coin_limit" => "required",
            "new_user_coin" => "required",
            "vacancy_response_limit" => "required",
            "gift_coin_amount" => "required",
            "job_response_cost" => "required",
            "job_vacancy_cost" => "required",
        ];
    }
}
