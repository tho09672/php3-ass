<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;// nhớ phải chuyển thành true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $arrRule= [
            'room_no'=>[
                'required',
                'min:3',
                Rule::unique('rooms')->ignore($this->id)
            ],
            'floor'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1'
        ];
        if($this->id==null){
            $arrRule['imageUpload']='required|mimes:jpg,bmp,png,jpeg|max:1000';
        }else{
            $arrRule['imageUpload']='mimes:jpg,bmp,png,jpeg|max:1000';
        }
        return $arrRule;
    }
    public function messages()
    {
        return [
            'room_no.required'=>'Trường này không được bỏ trống',
            'room_no.min'=>'Trường này cần ít nhất 3 ký tự',
            'room_no.unique'=>'Tên này đã tồn tại',
            'floor.required'=>'Trường này không được bỏ trống',
            'floor.numeric'=>'Chỉ được dùng định dạng số',
            'floor.min'=>'Floor cần lớn hơn 0',
            'price.required'=>'Trường này không được bỏ trống',
            'price.numeric'=>'Chỉ được dùng định dạng số',
            'price.min'=>'Price cần lớn hơn 0',
            'imageUpload.required'=>'Bạn chưa chọn ảnh',
            'imageUpload.mimes'=>'Ảnh không đúng định dạng',
            'imageUpload.max'=>'Ảnh không quá 100kb',

        ];
    }
}
