<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|unique:posts,title',
            'idea' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'La :attribute es obligatorio.',
            'category_id.exists' => 'La :attribute no existe en la base de datos.',
            'title.required' => 'El :attribute es obligatorio.',
            'title.string' => 'El :attribute debe ser una cadena de caracteres válidos.',
            'title.unique' => 'El :attribute ya existe en la base de datos.',
            'idea.required' => 'La :attribute es obligatorio.',
            'idea.string' => 'La :attribute debe ser una cadena de caracteres válidos.'

        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'categoría',
            'title' => 'título',
            'idea' => 'idea principal'
        ];
    }
}
