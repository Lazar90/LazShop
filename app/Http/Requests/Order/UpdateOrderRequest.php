<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status'     => ['required', 'in:paid,shipped,delivered,dispute,refunded'],
            'shipped_at' => ['nullable', 'date', 'required_if:status,shipped'],
            'deliver_at' => ['nullable', 'date'],
            'country'    => ['required', 'string', 'max:255'],
            'state'      => ['nullable', 'string', 'max:255'],
            'city'       => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'zipcode'    => ['nullable', 'string', 'max:255'],
        ];
    }
}
