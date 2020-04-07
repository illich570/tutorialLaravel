<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
          'title' => 'required|min:5|max:10',
          'content' => 'required|min:10|max:50'
        ];
    }

    public function messages() {
      return [
        'title.required' => 'El titulo es requerido por favor.',
        'content.min' =>'El contenido es de muy poco caracteres'
      ];
    }
}
