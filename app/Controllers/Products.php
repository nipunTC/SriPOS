<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\supplierModel;

class Products extends BaseController
{
    public function index()
    {
         // set page title
        $this->productModel = new ProductModel();
        $data['title'] = 'Products';
        $data['products'] = $this->productModel->findAll();
        return view('dashboard/products/view', $data);
    }
    public function create()
    {
        $data['title'] = 'Add Products';
        $this->categoryModel = new CategoryModel();
        $this->supplierModel = new SupplierModel();
        // load categories from database
        $data['categories'] = $this->categoryModel->findAll();
        //load supplier table has brands
        $data['brands'] =$this->supplierModel->select('supplier_id, supplier_name')->findAll();
        return view('dashboard/products/add', $data);
    }
    public function store()
    {
        $this->productModel->save([
            'product_code' => $this->request->getPost('product_code'),
            'name' => $this->request->getPost('name'),
            'product_img' => $this->request->getPost('product_img'),
            'description' => $this->request->getPost('description'),
            'category_id' => $this->request->getPost('category_id'),
            'brand_id' => $this->request->getPost('brand_id'),
            'unit_id' => $this->request->getPost('unit_id'),
            'tax_id' => $this->request->getPost('tax_id'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/products');
    }
    public function getByCode($code)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->where('product_code', $code)->first();

        if ($product) {
            return $this->response->setJSON([
                'success' => true,
                'product_name' => $product['name'], // adjust field name
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
            ]);
        }
    }
}
