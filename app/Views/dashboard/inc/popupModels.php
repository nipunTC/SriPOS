<!-- Category add Modal -->
<div class="modal blured-popup fade" id="addCategoryModelPopup" tabindex="-1" aria-labelledby="addCategoryModelPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-container p-4">
        <div class="close-popup" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></div>
          <h4 class="section-title">Add New Category</h4>
          <form id="addCategoryForm">
            <?= csrf_field() ?>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label" for="category_name">Category Name <span class="input_requred">*</span></label>
                <input type="text" id="category_name" name="category_name" class="form-control" required>
                <small class="errors_display" style="color: red;">
                  <!-- json errors display -->
                  
              </div>
              <div class="col-sm-12 mt-3">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="category_description" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-sm-12 mt-4">
                <button type="submit" class="btn btn-primary"> <i class="mdi mdi-content-save"></i> Save </button>
              </div>
            </div>
          </form>
        </div>  
      </div>
  </div>
</div>

<!-- Category edit Modal -->
 <script>
  $(document).ready(function(){
    $("#addCategoryForm").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('categories/store'); ?>", // CI4 route
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                if(response.success){
                    // Add new option to select
                    $("#category_id").append(
                        $('<option>', {
                            value: response.data.id,
                            text: response.data.category_name,
                            selected: true // auto-select new category
                        })
                    );

                    // Close modal
                    $("#addCategoryModelPopup").modal('hide');

                    // Reset form
                    $("#addCategoryForm")[0].reset();
                } else {
                    $(".errors_display").html(response.message || JSON.stringify(response.errors));
                }
            }
        });
      });
      // when user click that category_id select box, remove error message
      $("#category_id").on("click", function(){
          $(".errors_display").html('');
      });
  });


  </script>