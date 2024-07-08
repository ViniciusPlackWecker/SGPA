<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:institutions,name,' . ($this->route('institution') ?? 'NULL') . ',id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da instituição é obrigatório.',
            'name.string' => 'O nome da instituição deve ser uma string.',
            'name.max' => 'O nome da instituição não pode exceder :max caracteres.',
            'name.unique' => 'Esta instituição já existe.',
        ];
    }
}