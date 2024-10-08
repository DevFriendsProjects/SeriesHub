<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSeriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'seasons' => 'required|integer|min:1|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da série é obrigatório.',
            'seasons.required' => 'O número de temporadas é obrigatório.',
            'seasons.integer' => 'O número de temporadas deve ser um número inteiro.',
            'seasons.min' => 'O número de temporadas pode ser de no mínimo 1.',
            'seasons.max' => 'O número de temporadas pode ser de no máximo 100.',
        ];
    }
}
