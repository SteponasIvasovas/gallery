<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryEntryRequest extends FormRequest
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
        'image' => 'required',
        'title' => 'required',
        'tags' => 'required|regex:/^#[a-zA-Z0-9_]+(?:[ ]#[a-zA-Z0-9_]+){0,5}$/',
        'tagline' => 'max:100',
        'about' => 'max:2000'
      ];
    }
}
