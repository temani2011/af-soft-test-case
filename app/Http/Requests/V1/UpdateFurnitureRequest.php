<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFurnitureRequest extends FormRequest
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
        $method = $this->method();

        $validationRules = [
            'name'        => ['required'],
            'description' => ['nullable'],
            'available'   => ['required', 'boolean'],
            'price'       => ['required', 'numeric', 'min:0'],
        ];

        if ($method === 'PATCH') {
            foreach ($validationRules as $name => $rules) {
                $validationRules[$name][] = 'sometimes';
            }
        }

        return $validationRules;
    }
}
