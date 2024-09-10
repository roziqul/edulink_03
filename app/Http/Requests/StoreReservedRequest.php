<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $now = Carbon::now();
        $duration = 'duration';
        

        return [
            'catalog_id' => 'required',
            'student_id' => 'required',
            'loan_started' => $now,
            'duration' => 'required',
            'loan_finished' => 'required',
        ];
    }
}
