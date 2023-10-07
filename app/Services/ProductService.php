<?php

namespace App\Services;

use App\Events\newProductEvent;
use App\Models\Product;
use Illuminate\Support\Facades\Event;

class ProductService
{
    public function getProducts()
    {
        return Product::all();
    }

    public function getProduct($id)
    {
        return Product::find($id)->first();
    }

    public function createProduct($data)
    {
        $product= Product::create($data);
        $product->details()->create($data);
//         Event::dispatch(new newProductEvent($product));
        return $product;
    }

   public function updateProduct($id,$data): Product
   {
       $product=$this->getProduct($id);
       $product->title=$data['title'];
       $product->description=$data['description'];
       $product->details->size = $data['size'];
       $product->details->color = $data['color'];
       $product->details->price = $data['price'];
       $product->save();
       return $product;
   }

    public function deleteProduct($id)
    {
        $product=$this->getProduct($id);

        if($product->details)
        {
            $product->details()->delete();
        }

        if($product->reviews)
        {
            $product->reviews()->delete();
        }

        if($product->imagable)
        {
            $product->imagable()->delete();
        }

        $product->delete();
    }

}
