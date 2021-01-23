<?php

namespace App\Http\Requests;

class CreateUserRequest extends AbstractRequest
{
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'The :attribute must not be empty',
        ];
    }

    public function getName(): string
    {
        return $this->getStringValue('name');
    }

    public function getLastName(): string
    {
        return $this->getStringValue('last_name');
    }
}
