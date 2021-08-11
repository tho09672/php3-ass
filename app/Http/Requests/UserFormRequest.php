<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
        $arrRule= [
            'name'=>'required|min:3',
            'email'=>[
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'phone'=>[
                'required',
                'numeric',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
        if($this->id==null){
            $arrRule['avataUpload']='required|mimes:jpg,bmp,png,jpeg|max:100';
            $arrRule['password']='required|min:5';
        }else{
            $arrRule['avataUpload']='mimes:jpg,bmp,png,jpeg|max:100';
        }
        return $arrRule;
    }
    public function messages()
    {
        return [
            'name.required'=>'Trường này không được bỏ trống',
            'name.min'=>'Trường này cần ít nhất 3 ký tự',
           
            'email.unique'=>'Email này đã tồn tại',
            'email.email'=>'Email không đúng định dạng',
            'email.required'=>'Trường này không được bỏ trống',
            
            'password.required'=>'Trường này không được bỏ trống',
            'password.min'=>'Password cần ít nhất 5 ký tự',
           
            'phone.required'=>'Trường này không được bỏ trống',
            'phone.numeric'=>'Chỉ được dùng định dạng số',
            'phone.unique'=>'Phone này đã tồn tại',
            
            'avataUpload.required'=>'Bạn chưa chọn ảnh',
            'avataUpload.mimes'=>'Ảnh không đúng định dạng',
            'avataUpload.max'=>'Ảnh không quá 100kb',

        ];
    }
}
