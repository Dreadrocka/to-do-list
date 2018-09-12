<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "title" => ["required", "string", "max:100"],
            "notes" => ["", "string"],
            "dueDate" => ["date"],
            "complete" => ["boolean"],
            "categories" => ["required", "array"], // check tags is an array
            "categories.*" => ["string", "max:30"], // check members of tags are strings
        ];
    }
}
