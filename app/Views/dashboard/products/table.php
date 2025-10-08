
<?php if($products): ?>
<table class="table" id="product_table">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Product Code / SKU</th>
            <th>Selling Price (LKR)</th>
            <th>Purchased Price (LKR)</th>
            <th>In Stock</th>
            <th>Description</th>
            <th>Created On</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 0;
        foreach($products as $p) : $i++ ?>
        <tr>
            <td><?= $i ?></td>
            <td><img src="<?= base_url().'/uploads/product_images/'.$p['product_image'] ?>" alt="" class="product-image" srcset=""></td>
            <td><?= $p['product_name'] ?></td>
            <td><?= $p['category_name'] ?></td>
            <td><?= $p['product_code'] ?></td>
            <td><?= $p['selling_price'] ?></td>
            <td><?= $p['pur_price'] ?></td>
            <td><?= $p['stock_amount'] ?></td>
            <td><?= $p['description']?? 'N/A'; ?></td>
            <td><?= date('Y-m-d', strtotime($p['created_at'])) ?></td>
            <td><?= date('Y-m-d', strtotime($p['updated_at'])) ?></td>
            <td>
                <!-- update button -->
                <button class="edit-btn editProductBtn" data-id="<?= $p['product_id'] ?>">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button onclick="showDeleteModal(<?= $p['product_id'] ?>)" class="delete-btn"> <i class="bi bi-trash3-fill"></i></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$totalPages = ceil($total / $limit);
if($totalPages > 1):
?>
<ul class="pagination">
    <?php for($i=1; $i<=$totalPages; $i++): 
        $active = $i == $page ? 'active' : '';
    ?>
        <li class="page-item <?= $active ?>">
            <a href="#" class="page-link" data-page="<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>
</ul>
<?php endif; ?>

<?php else: ?>
<p>No products found.</p>
<?php endif; ?>
