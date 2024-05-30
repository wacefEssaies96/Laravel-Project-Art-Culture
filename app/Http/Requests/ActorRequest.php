<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullName' => 'required|max:30',
            'email' => 'required',
            'phoneNumber' => 'required|numeric',
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthDate' => 'required|date|before:today',
        ];
    }

    public function messages()
    {
        return [
            'birthDate.before' => 'The birthDate cannot be after today !',
            'profilePicture.image' => 'The profilePicture format must be jpeg, png, jpg, gif or svg !'
        ];
    }
}
