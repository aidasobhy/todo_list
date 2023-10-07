<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;


class ProductsExport implements FromArray
{

    public function array():array
    {
        $list=[];
        $products=Product::all();
        foreach ($products as $product){
            $list[]=[$product->title,$product->description,$product->user_id,$product->user->name];
        }
        return $list;
    }
}
