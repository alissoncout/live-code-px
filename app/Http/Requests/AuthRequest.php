<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $path = $this->path(); // ou: request()->path()

        if ($path === 'register') {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ];
        }

        if ($path === 'login') {
            return [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string',
            ];
        }

        return [];
    }
}
