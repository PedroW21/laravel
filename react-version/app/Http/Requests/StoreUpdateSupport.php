<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
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
        $rules = [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:10000',
            ]
        ];

        if ($this->method() === 'PUT') {
            $rules['subject'] = [
                'required',
                'min:3',
                'max:255',
                #"unique:supports,subject,{$this->id},id" // the third parameter is the id of the current support being updated (if it exists) and the fourth parameter is the column name to be used in the query (in this case, subject) 
                // if the subject is the same as the one in the database, it will not be considered as a duplicate (ignore validation)/
                
                /* ANOTHER METHOD TO DO THE LINE 38 */
                Rule::unique('supports')->ignore($this->id),
                
            ];

            return $rules;
        }
    }
}
