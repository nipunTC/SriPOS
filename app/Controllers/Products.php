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
        $products = $db->query("SELECT * FROM products")->getResult();
        $data = [
            'title' => 'View Products',
            'categories' => $categories
        ];

        return view('dashboard/products/view', $data);
    }
    // get single product by id
    public function get($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return $this->response->setJSON(['error' => 'Product not found']);
        }

        return $this->response->setJSON($product);
    }
    // load ajax with category list
    public function getCategories()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        return $this->response->setJSON($categories);

    }
    // load ajax with brand list
    public function getBrands()
    {
        $supplierModel = new SupplierModel();
        $brands = $supplierModel->select('supplier_id, supplier_name')->findAll();
        return $this->response->setJSON($brands);

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
    // product update function
   public function update()
{
    if ($this->request->isAJAX()) {

        $productId = $this->request->getPost('product_id');
        // ✅ Load validation service
        $validation = \Config\Services::validation();

        // ✅ Define rules
        $rules = [
            'bar_code'       => 'required',
            'product_name'   => 'required',
            'category_id'    => 'required',
            'brand_id'       => 'required',
            'pur_price'      => 'required|decimal',
            'selling_price'  => 'required|decimal',
            'stock_amount'   => 'required|integer',
            'alert_quantity' => 'required|integer',
        ];


        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'filed_name' => $validation->getErrors(),
                'message' => $validation->listErrors()
            ]);
        }

        $existingImage = $this->request->getPost('existing_image');
        $imageFile = $this->request->getFile('product_image');
        $imageName = $existingImage;

        // ✅ Handle new image upload
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $oldImagePath = FCPATH . 'uploads/product_images/' . $existingImage;
            if (!empty($existingImage) && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $uploadPath = FCPATH . 'uploads/product_images/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $imageName = time() . '_' . $imageFile->getRandomName();
            $imageFile->move($uploadPath, $imageName);
        }

        // ✅ Prepare update data
        $data = [
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
            'description'    => $this->request->getPost('description'),
            'product_image'  => $imageName,
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        $updated = $this->productModel->update($productId, $data);

        if ($updated) {
            session()->setFlashdata('success', $this->request->getPost('product_name').' updated successfully!');
            return $this->response->setJSON([
                'success' => true,
                'message' => session()->getFlashdata('success'),
            ]);
        } else {
            session()->setFlashdata('error', 'Failed to update product!');
            return $this->response->setJSON([
                'success' => false,
                'message' => session()->getFlashdata('error'),
            ]);
        }

    } else {
        return redirect()->back();
    }
}


    // products print function
    public function printProducts()
    {
        $category = $this->request->getGet('category') ?? null;
        $search   = $this->request->getGet('search') ?? null;

        $products = $this->productModel->getFiltered($category, $search, null, null);

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Product List', 0, 1, 'L');

        // Table header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, 'ID', 1);
        $pdf->Cell(50, 10, 'Name', 1);
        $pdf->Cell(40, 10, 'Category', 1);
        $pdf->Cell(30, 10, 'Price', 1);
        $pdf->Cell(40, 10, 'Created', 1);
        $pdf->Ln();

        // Table data
        $pdf->SetFont('Arial', '', 12);
        foreach ($products as $p) {
            $pdf->Cell(10, 10, $p->id, 1);
            $pdf->Cell(50, 10, $p->name, 1);
            $pdf->Cell(40, 10, $p->category, 1);
            $pdf->Cell(30, 10, $p->price, 1);
            $pdf->Cell(40, 10, $p->created_at, 1);
            $pdf->Ln();
        }

        // Set headers to force download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="product_list.pdf"');
        $pdf->Output('D', 'product_list.pdf'); // 'D' forces download
        exit; // Stop further execution
    }
    public function JSONRefreshTable()
    {
        $category = $this->request->getPost('category');
        $search   = $this->request->getPost('search');
        $page     = $this->request->getPost('page') ?? 1;
        $limit    = $this->request->getPost('limit') ?? 5;
        $offset   = ($page - 1) * $limit;

        $rowNum = 1;
        $products = $this->productModel->getFiltered($category, $search, $limit, $offset,$rowNum);
        $total    = $this->productModel->countFiltered($category, $search);
        return $this->response->setJSON([
            'products' => $products,
            'total'    => $total,
            'page'     => $page,
            'limit'    => $limit
        ]);
    }
    public function delete()
    {
        $productID = $this->request->getPost('product_id');
        $product = $this->productModel->find($productID);
        if ($product) {
            // Delete associated image file if exists
            if (!empty($product['product_image'])) {
                $imagePath = FCPATH . 'uploads/product_images/' . $product['product_image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete product from database
            $this->productModel->delete($productID);

            session()->setFlashdata('success', 'Product deleted successfully!');
            return $this->response->setJSON([
                'success' => true,
                'message' => session()->getFlashdata('success'),
            ]);
        } else {
            session()->setFlashdata('error', 'Product not found!');
            return $this->response->setJSON([
                'success' => false,
                'message' => session()->getFlashdata('error'),
            ]);
        }
    }
    // test function
    public function Test()
    {
        if ($this->request->isAJAX()) {
            $productID = $this->request->getPost('product_id');
            return $this->response->setJSON([
                'success' => true,
                'productID' => $productID,
            ]);
        }
    }
}
