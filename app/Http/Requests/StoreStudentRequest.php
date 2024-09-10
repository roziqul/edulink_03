<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'mimes:jpeg,png,jpg |max:4096',
            'nisn' => 'required|unique:students,nisn',
            'class' => 'required',
            'fullname' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'student'
        ];
    }
}
