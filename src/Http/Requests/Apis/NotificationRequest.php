<?php

namespace Botble\Notification\Http\Requests\Apis;

use Botble\Support\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NotificationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'notifiable_id' => 'required',
            'notifiable_type' => 'required',
            'title' => ['required', 'string'],
            'body' => ['required'],
            'url' => ['sometimes'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function validationData()
    {
        return $this->all();
    }

    protected  function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors() , 'statusCode' => 422], 422));
    }

}
