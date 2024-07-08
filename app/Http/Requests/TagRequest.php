<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name,' . ($this->route('tag') ?? 'NULL') . ',id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da tag é obrigatório.',
            'name.string' => 'O nome da tag deve ser uma string.',
            'name.max' => 'O nome da tag não pode exceder :max caracteres.',
            'name.unique' => 'Esta tag já existe.',
        ];
    }
}