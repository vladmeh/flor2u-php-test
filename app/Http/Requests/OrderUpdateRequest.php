<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required|numeric|in:0,10,20'
        ];
    }

    public function attributes()
    {
        return [
            'client_email' => 'Клиент',
            'partner_id' => 'Партнер',
            'status' => 'Статус'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'поле :attribute не должно быть пустым',
            'email' => 'Некорректный email адрес',
        ];
    }


}
