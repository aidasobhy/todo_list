<?php

namespace App\Requests\Products;

use App\Requests\BaseRequestFormApi;

class UpdateProductValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        $id=$this->getRequest()->segment(4);


        return [
            'title' => 'required|string|min:3|max:100|unique:products,title,' . $id .',id' ,
            'description' => 'required|min:3|max:1000',
            'size'        => 'required|numeric|min:30|max:100',
            'color'       => 'required|in:red,green',
            'price'       => 'nullable|numeric|min:1|max:20000'
        ];

    }
        public function authorized(): bool
        {
            return true;
        }

}
