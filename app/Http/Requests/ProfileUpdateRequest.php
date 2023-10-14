<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $this->user()->id,
            'bio' => 'nullable|string|max:500',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
