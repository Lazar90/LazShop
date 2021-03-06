<?php

namespace App\Http\Requests\Coupon;

use App\Models\Coupon;
use App\Rules\CouponAmount;
use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
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
            'code'        => ['required', 'string', 'unique:coupons,code'],
            'type'        => ['required', 'in:fixed,percent'],
            'amount'      => ['required', 'integer', 'min:1', new CouponAmount()],
            'expiry_date' => ['nullable', 'required_if:quantity,null', 'date', 'after:today'],
        ];
    }
}
