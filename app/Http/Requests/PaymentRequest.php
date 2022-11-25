<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
        return match (request()->method()) {
            'POST' => $this->store(),
            'PUT' => $this->update()
        };
    }

    public function store()
    {
        return [
            'id_method_of_payment'          => ['required', 'unique:md_method_of_payments,id_method_of_payment'],
            'name_method_of_payment'        => ['required'],
        ];
    }

    public function update()
    {
        return [
            'id_method_of_payment'          => ['nullable', Rule::unique('md_method_of_payments')->ignore($this->md_method_of_payment->id_method_of_payment, 'id_method_of_payment')],
            'name_method_of_payment'        => ['required'],
        ];
    }
}
