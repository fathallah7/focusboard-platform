<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])],
            'due_date' => 'nullable|date',
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'title.string' => 'The title must be a string',
            'title.max' => 'The title may not be greater than 255 characters',
            'description.string' => 'The description must be a string',
            'status.required' => 'A status is required',
            'status.in' => 'The status must be one of the following: pending, in_progress, completed',
            'due_date.date' => 'The due date must be a valid date',
            'priority.required' => 'A priority is required',
            'priority.in' => 'The priority must be one of the following: low, medium, high',
        ];
    }
}
