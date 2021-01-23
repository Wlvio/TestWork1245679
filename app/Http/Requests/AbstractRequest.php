<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class AbstractRequest
{
    protected Request $request;
    private MessageBag $errors;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function validate(): bool
    {
        $data = $this->request->all();

        if (! is_array($data)) {
            throw new \RuntimeException('Request data must be array');
        }

        $validator = Validator::make(
            $data,
            $this->rules(),
            $this->messages()
        );

        $this->errors = $validator->errors();

        return ! $validator->fails();
    }

    protected function rules(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }
    
    public function errors(): MessageBag
    {
        return $this->errors;
    }

    protected function getStringValue(string $name): string
    {
        $value = $this->request->input($name);
        if (! is_string($value)) {
            throw new \RuntimeException('Value not string, is' . gettype($value));
        }

        return $value;
    }

    protected function getIntegerValue(string $name): string
    {
        $value = $this->request->input($name);
        if (! is_integer($value)) {
            throw new \RuntimeException('Value not integer, is' . gettype($value));
        }

        return $value;
    }
}
