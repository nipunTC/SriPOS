<?= view('dashboard/inc/header') ?>

<div class="container-scroller">
      <?= view('dashboard/inc/sidebar') ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?= view('dashboard/inc/navbar') ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="top-row">
                      <div class="left-side">
                        <h4 class="card-title">Products</h4>
                        <p class="card-description">
                          You can add/remove/edit products here.
                        </p>
                      </div>
                      <div class="right-side">
                        <div class="filters-row">
                          <div class="filter-container search">
                              <label for="filterSearch"><i class="bi bi-search"></i> </label>
                              <input type="text" id="filterSearch" class="form-control" placeholder="Search Product...">
                          </div>
                          <div class="filter-container cat-filter">
                              <label for="filterCategory">Show</label>
                              <select id="filterCategory"  class="form-control">
                                  <option value="">All Categories</option>
                                  <?php foreach($categories as $c): ?>
                                      <option value="<?= $c->category_id ?>"><?= $c->category_name ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="filter-container rows-per-page-filter">
                              <label for="rowsPerPage">Rows per Page</label>
                              <select id="rowsPerPage"  class="form-control">
                                  <option value="5">05</option>
                                  <option value="10" selected>10</option>
                                  <option value="20">20</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                          </div>
                          <div class="btn-group export-btn">
                            <button type="button" class="btn btn-success">Export</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton3" style="">
                              <h6 class="dropdown-header">Export As</h6>
                              <a class="dropdown-item" href="#">PDF</a>
                              <a class="dropdown-item" href="#">CVS</a>
                            </div>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="system-table table-responsive">
                      <div id="productDataTable"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?= view('dashboard/inc/foot') ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(function(){
  function loadTable(page=1){
        $.post("<?= site_url('products/fetch') ?>", {
            category: $("#filterCategory").val(),
            search: $("#filterSearch").val(),
            page: page,
            limit: $("#rowsPerPage").val()
        }, function(data){
            $("#productDataTable").html(data); // Load HTML from partial view
        });
    }
    loadTable();
    
     $("#filterCategory, #filterSearch, #rowsPerPage").on("change keyup", function(){
        loadTable();
    });

    $(document).on("click", ".pagination a", function(e){
        e.preventDefault();
        let page = $(this).data("page");
        loadTable(page);
    });
});
</script>
<?= view('dashboard/inc/footer') ?>
<!-- products table load AJAX part  -->
