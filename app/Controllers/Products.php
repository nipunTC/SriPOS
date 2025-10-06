<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\supplierModel;

class Products extends BaseController
{
    protected $productModel;
    protected $helpers = ['form'];
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $db = db_connect();
        $categories = $db->query("SELECT * FROM categories")->getResult();
       
        return view('dashboard/products/view', ['categories' => $categories]);
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
    public function fetch()
    {
        $category = $this->request->getPost('category');
        $search   = $this->request->getPost('search');
        $page     = $this->request->getPost('page') ?? 1;
        $limit    = $this->request->getPost('limit') ?? 5;
        $offset   = ($page - 1) * $limit;

        $rowNum = 1;
        $products = $this->productModel->getFiltered($category, $search, $limit, $offset,$rowNum);
        $total    = $this->productModel->countFiltered($category, $search);
        return view('dashboard/products/table', [
            'products' => $products,
            'total'    => $total,
            'page'     => $page,
            'limit'    => $limit
        ]);
    }
    public function store()
    {
        $this->productModel = new ProductModel();
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $rules = [
                'product_code'   => 'required|is_unique[products.product_code]',
                'bar_code'       => 'required',
                'product_name'   => 'required',
                'category_id'    => 'required',
                'brand_id'       => 'required',
                'pur_price'      => 'required|decimal',
                'selling_price'  => 'required|decimal',
                'stock_amount'   => 'required|integer',
                'alert_quantity' => 'required|integer',
                'product_image'  => 'uploaded[product_image]|max_size[product_image,1024]|is_image[product_image]'
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => $validation->listErrors()
                ]);
            }

            // ✅ Handle Image Upload
            $imageName = null;
            $imageFile = $this->request->getFile('product_image');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                // Upload path (public/uploads/product_images/)
                $uploadPath = FCPATH . 'uploads/product_images/';

                // Create folder if not exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Generate unique filename
                $imageName = time() . '_' . $imageFile->getRandomName();

                // Move file
                $imageFile->move($uploadPath, $imageName);
            }

            // ✅ Insert product into DB
            $this->productModel->insert([
                'product_code'   => $this->request->getPost('product_code'),
                'bar_code'       => $this->request->getPost('bar_code'),
                'product_name'   => $this->request->getPost('product_name'),
                'category_id'    => $this->request->getPost('category_id'),
                'brand_id'       => $this->request->getPost('brand_id'),
                'pur_price'      => $this->request->getPost('pur_price'),
                'selling_price'  => $this->request->getPost('selling_price'),
                'stock_amount'   => $this->request->getPost('stock_amount'),
                'alert_quantity' => $this->request->getPost('alert_quantity'),
                'exp_date'       => $this->request->getPost('exp_date'),
                'status'         => $this->request->getPost('status') ? 1 : 0,
                'description'    => $this->request->getPost('productDescription'),
                'product_image'  => $imageName // save only filename in DB
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Product added successfully',
                'image'   => base_url('uploads/product_images/' . $imageName) // return image path
            ]);
        }
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
    public function filter($categoryId)
    {
        if ($this->request->isAJAX()) {
            $products = $this->productModel
                ->where('category_id', $categoryId)
                ->findAll();

            return $this->response->setJSON($products);
        }

        return redirect()->back();
    }
}
