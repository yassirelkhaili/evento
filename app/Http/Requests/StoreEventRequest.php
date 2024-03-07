<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category' => 'required|integer|exists:categories,id',
            'address' => 'required|string|max:255',
            'validation_method' => 'required|in:automatic,manual',
            'date' => 'required|date_format:m/d/Y|after_or_equal:' . Carbon::now()->format('m/d/Y'),
            'available_seats' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0|gte:available_seats',
            'description' => 'required|string',
            'event_picture' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
