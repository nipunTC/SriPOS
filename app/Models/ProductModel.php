<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'product_code',
        'bar_code',
        'product_name',
        'category_id',
        'brand_id',
        'pur_price',
        'selling_price',
        'stock_amount',
        'alert_quantity',
        'productDescription',
        'exp_date',
        'status',
        'product_image'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'product_code'   => 'required|is_unique[products.product_code]',
        'product_name'   => 'required|min_length[3]',
        'category_id'    => 'required|integer',
        'brand_id'       => 'required|integer',
        'pur_price'      => 'required|decimal',
        'selling_price'  => 'required|decimal',
        'stock_amount'   => 'permit_empty|integer',
        'alert_quantity' => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'product_code' => [
            'required'  => 'Product code is required',
            'is_unique' => 'This product code already exists'
        ],
        'product_name' => [
            'required' => 'Product name is required'
        ]
    ];

    protected $skipValidation = false;

    // ✅ Get all products with category name
    public function getProductsWithCategory()
    {
        return $this->select('products.*, categories.category_name as category_name')
                    ->join('categories', 'categories.category_id = products.category_id', 'left')
                    ->findAll();
    }

    // ✅ Filtered products with pagination
    public function getFiltered($category = null, $search = null, $limit = 5, $offset = 0)
    {
        $builder = $this->db->table('products p')
                    ->select('p.*, c.category_name as category_name')
                    ->join('categories c', 'c.category_id = p.category_id', 'left')
                    ->limit($limit, $offset);

        if ($category) {
            $builder->where('p.category_id', $category);
        }

        if ($search) {
            $builder->groupStart()
                            ->like('p.product_name', $search)
                            ->orLike('p.bar_code', $search)
                            ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    // ✅ Count total filtered products
    public function countFiltered($category = null, $search = null)
    {
        $builder = $this->db->table('products p')
                    ->join('categories c', 'c.category_id = p.category_id', 'left');

        if ($category) {
            $builder->where('p.category_id', $category);
        }

        if ($search) {
            $builder->groupStart()
                            ->like('p.product_name', $search)
                            ->orLike('p.bar_code', $search)
                            ->groupEnd();
        }

        return $builder->countAllResults();
    }
}
