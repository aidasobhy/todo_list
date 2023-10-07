<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Requests\Products\CreateProductValidator;
use App\Requests\Products\ImportProductValidator;
use App\Requests\Products\UpdateProductValidator;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends BaseController
{
//      var_dump(class_exists('Bar'), class_exists('\Foo\Bar')); //false, true



    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        return $this->productService->getProducts();
    }

    public function store(CreateProductValidator $createProductValidator)
    {
        if (!empty($createProductValidator->getErrors())) {
            return response()->json($createProductValidator->getErrors(), '406');
        }

        $data            = $createProductValidator->getRequest()->all();
        $data['user_id'] = Auth::user()->id;
        $product         = $this->productService->createProduct($data);
        return $this->sendResponse($product);
    }


    public function update($id,UpdateProductValidator $updateProductValidator)
    {
        if (!empty($updateProductValidator->getErrors())) {
            return response()->json($updateProductValidator->getErrors(), '406');
        }

        $data            = $updateProductValidator->getRequest()->all();
        $data['user_id']=Auth::user()->id;
        $product         = $this->productService->updateProduct($id,$data);
        return $this->sendResponse($product);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return $this->sendResponse('deleted successfully');
    }


    public function export()
    {
       return Excel::download(new ProductsExport(),'export1.xlsx');
    }


    public function import(ImportProductValidator $importProductValidator)
    {
        if (!empty($importProductValidator->getErrors())) {
            return response()->json($importProductValidator->getErrors(), '406');
        }

        Excel::import(new ProductsImport(),$importProductValidator->getRequest()->file('file')->store('files'));
        return $this->sendResponse('Saved');
    }

}
