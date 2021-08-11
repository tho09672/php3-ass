<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
        $ruleArr =  [
            'name'=>[
                'required',
                'min:3',
                Rule::unique('services')->ignore($this->id)
            ],
        ];
        if($this->id == null){
            $ruleArr['iconUpload'] = 'required|mimes:jpg,bmp,png,jpeg|max:20';
        }else{
            $ruleArr['iconUpload'] = 'mimes:jpg,bmp,png,jpeg|max:20';
        }
        return $ruleArr;
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên dịch vụ không được bỏ trống',
            'name.min'=>'Tên dịch vụ cần tối thiểu 3 ký tự',
            'name.unique'=>'Tên dịch vụ đã tồn tại',
            'iconUpload.required'=>'Icon không được bỏ trống',
            'iconUpload.mimes'=>'Icon không đúng định dạng',
            'iconUpload.max'=>'Icon không được quá 20kb',
        ];
    }
}
