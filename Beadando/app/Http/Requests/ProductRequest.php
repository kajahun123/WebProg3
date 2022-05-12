<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'title'=>'required|min:2|max:240',
                'type_id'=> 'required|exists:types,id',
                'publisher_id'=> 'required|exists:publishers,id',
                'price'=>'required|numeric',
                'description'=>'required',
                'content'=>'required',
                'cover'=>'file|image',
            
        ];
    }
}
