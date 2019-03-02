<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateRequest extends FormRequest
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
            'title' => 'required|max:191',
//            're_category_id' => 'required',
//            're_type_id' => 'required',
//            'district_id' => 'required',
//            'ward_id' => 'required',
//            'street_id' => 'required',
//            'direction_id' => 'required',
//            'exhibit_id' => 'required',
//            'project_id' => 'required',
//            'block_id' => '',
//            'construction_type_id' => '',
//            'width' => '',
//            'length' => '',
//            'bedroom' => '',
//            'area_of_premises' => 'required',
//            'area_of_use' => '',
//            'floor' => '',
//            'price' => '',
//            'unit_id' => '',
//            'range_price_id' => '',
//            'is_deal' => '',
//            'post_date' => 'required',
//            'expire_date' => 'required',
            'detail' => 'required',
        ];
    }

    /*
     * @return array
     *  */
    public function messages()
    {
        return [
            'title.required' => 'Nhập tiêu đề tin',
            'title.max' => 'Tiêu đề tối đa 191 ký tự',
            'short_description.required' => 'Nhập mô tả ngắn',
            'short_description.max' => 'Mô tả ngắn không nhiều hơn 150 ký tự',
            'contact_person.required' => 'Nhập người liên hệ',
            'contact_phone_number.required' => 'Nhập điện thoại liên hệ',
            'contact_address.required' => 'Nhập địa chỉ liên hệ',
            're_category_id.required' => 'Chọn danh mục',
            're_type_id.required' => 'Chọn loại BĐS',
            'province_id.required' => 'Chọn tỉnh/thành phố',
            'district_id.required' => 'Chọn quận/huyện',
            'ward_id.required' => 'Chọn phường/xã',
            'address.required' => 'Nhập địa chỉ nhà đất',
            'street_id.required' => 'Chọn đường phố',
            'direction_id.required' => 'Chọn hướng',
            'exhibit_id.required' => 'Chọn giấy tờ',
            'project_id.required' => 'Chọn dự án',
            'area_of_premises.required' => 'Nhập diện tích mặt bằng',
            'post_date.required' => 'Chọn ngày đăng',
            'expire_date.required' => 'Chọn ngày hết hạn',
            'detail.required' => 'Nhập nội dung chi tiết',
        ];
    }
}
