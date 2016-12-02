<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Question extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'question' => 'required|min:2|max:255',
            'order_no' => 'required|min:1|max:10'];
    }

}
