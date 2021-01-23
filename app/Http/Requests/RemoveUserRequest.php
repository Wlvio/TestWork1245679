<?php

namespace App\Http\Requests;

class RemoveUserRequest extends AbstractRequest
{
    protected function rules(): array
    {
        return [
            'id' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'The :attribute must not be empty',
        ];
    }

    public function getId(): string
    {
        return $this->getIntegerValue('id');
    }
}
