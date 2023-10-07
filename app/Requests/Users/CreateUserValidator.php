<?php

namespace App\Requests\Users;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
