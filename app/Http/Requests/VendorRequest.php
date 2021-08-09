<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo'=>'required_without:id|mimes:jpg,jpeg,png',
            'mobile'=>'required|max:50|unique:vendors,mobile,'.$this->id,     //sometimes|nullable يعنى ممكن يدخل وممكن لا| وممكن يكون فاضى
            'email'=>'required|email|unique:vendors,email,'.$this->id,   //except for this user
            'category_id'=>'required|exists:main_categories,id',
            'name'=>'required|string|max:150',
            'address'=>'required|string|max:500',
            'password'=>'required_without:id',
        ];
    }
    public function messages()
    {
        return [

            'required'=>'هذا الحقل مطلوب',
            'max'=>'هذا الحقل طويل جدا ',
            'category_id.exists'=>'هذا القسم غير موجود ',
            'email.email'=>'رجاء ادخال الايميل بصيغه صحيحة',
            'address.string'=>'العنوان لابد ان يكون حروف وارقام',
            'address.string'=>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'logo.required_without'=>'الصورة مطلوبة',
            'mobile.unique'=>'هذا الموبايل مستخدم مسبقا ',
            'email.unique'=>'هذا الايميل مستخدم مسبقا ',
            'password.min'=>'الباسورد لا يجب ان يقل عن 6 احرف',
        ];
    }

}
