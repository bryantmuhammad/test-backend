<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockRequest extends FormRequest
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
            'id_product' => ['required', 'unique:md_stocks,id_product'],
            'harga'     => ['required', 'numeric'],
            'stok'      => ['required', 'numeric']
        ];
    }

    public function update()
    {
        return [
            'id_product' => ['nullable', Rule::unique('md_stocks')->ignore($this->md_stock->id_product, 'id_product')],
            'harga'     => ['required', 'numeric'],
            'stok'      => ['required', 'numeric']
        ];
    }
}
