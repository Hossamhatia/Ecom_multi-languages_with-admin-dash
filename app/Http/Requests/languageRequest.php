<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class languageRequest extends FormRequest
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
            'name'=>'required|max:100',
            'abbr'=>'required|string|min:2|max:10',
            'direction'=>'required|in:ltr,rtl',



        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'رجاء ادخال اسم اللغه ',
            'name.max'=>'رجاء ادخال اسم اللغه اقل من 100 حرف ',
            'abbr.required'=>'برجاء ادخال اسم الاختصار',
            'abbr.string'=>'برجاء ادخال اسم الاختصار بالحروف',
            'abbr.min'=>'برجاء ادخال اسم الاختصار اكثر من حرفين ',
            'abbr.max'=>'برجاء ادخال اسم الاختصار اقل  من 10 حروف ',
            'direction.required'=>'رجاء اختيار قيمه الاتجاه من الصندوق بالاعلى',
            'direction.in'=>'رجاء اختيار قيمه الاتجاه من ضمن rtl او ltr',

        ];

    }
}
