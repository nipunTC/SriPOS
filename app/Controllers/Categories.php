<?php 
namespace App\Controllers;

use App\Models\CategoryModel;
class Categories extends BaseController
{
    public function store()
    {
        try {
            $categoryModel = new CategoryModel();

            // Get posted data
            $name = $this->request->getPost('category_name');
            $category_description = $this->request->getPost('category_description');
            $status = 1; // default active

            // Debug log (appears in browser response)
            if (empty($name)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Category name is empty'
                ]);
            }

   
            //category name is unique, so if insert fails, $id will be false
            $query = $categoryModel->where('category_name', $name)->first();
            if ($query) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Category name already exists'
                ]);
            }else{
                $id = $categoryModel->insert(['category_name' => $name, 'description' => $category_description, 'status' => $status]);
         
                if (!$id) {
                    // Show model errors
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Insert failed',
                        'errors' => $categoryModel->errors()
                    ]);
                }
            }

            // Success
            return $this->response->setJSON([
                'success' => true,
                'data' => ['id' => $id, 'category_name' => $name, 'description' => $category_description, 'status' => $status]
            ]);

        } catch (\Throwable $e) {
            // Catch and show error
            return $this->response->setJSON([
                'success' => false,
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine()
            ]);
        }
    }
}
