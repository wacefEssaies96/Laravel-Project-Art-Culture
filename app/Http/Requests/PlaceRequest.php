<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'facilities' => 'nullable|array', // You can specify more specific validation rules for arrays if needed.
            'accessibility' => 'nullable|string|max:255',
            'internal_rules' => 'nullable|string',
            'photos' => 'nullable|array',
            'website' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'social_media_links' => 'nullable|array',
            'rental_cost' => 'nullable|numeric',
            'comments_and_reviews' => 'nullable|array',
            'past_events' => 'nullable|array',
            'upcoming_events' => 'nullable|array',
            'internal_notes' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string',
            'parking_fees' => 'nullable|string',
            'catering_services' => 'nullable|string',
            'booking_conditions' => 'nullable|string',
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'The name field is required.',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'The email address is already taken.',
        // Define custom messages for specific rules...
    ];
}
}
