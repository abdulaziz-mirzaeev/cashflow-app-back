<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', 'integer', Rule::in(array_keys(Transaction::$types))],
            'amount' => ['required', 'gt:0'],
            'comment' => ['required', 'max:255'],
            'currency' => [Rule::in(array_keys(Transaction::$currencies))]
        ];
    }

}
