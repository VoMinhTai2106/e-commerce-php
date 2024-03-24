
<div class="content-wrapper">
    <section class="content ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-2">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th  style="width: 70px;  min-height:50px ">Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sale</th>
                    <th>Stock Quantity</th>
                    <th>Active</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $product= new productModel();
                    $result= $product->getAllProduct();
                    while ($set = $result->fetch()) :
                     ?>
                    <tr>
                        <td><img src="/content/images/products/<?php  echo $set['default_image_path']; ?>" alt=""  width="100%"></td>
                        <td><?php echo $set['name'];?></td>
                        <td><?php echo $set['category_name'];?></td>
                        <td><?php echo $set['price'];?></td>
                        <td><?php echo $set['sale'];?></td>
                        <td><?php echo $set['stock_quantity'];?></td>
                        <td><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input <?php if ( $set['active']==1) {
                        echo 'checked';
                      } ?> type="checkbox" class="custom-control-input" id="customSwitch31<?php echo $set['product_id'];?>">
                      <label class="custom-control-label" for="customSwitch31<?php echo $set['product_id'];?>"></label>
                    </div></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?action=productEdit&productId=<?php echo $set['product_id'] ?>">Edit</a> 
                        </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
                  <tfoot>
                  <tr>
                  <th >Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sale</th>
                    <th>Stock Quantity</th>
                    <th>Active</th>
                    <th>action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('input[type="checkbox"]').on('change', function() {
      // Lấy giá trị của checkbox
      var checkboxValue = $(this).prop('checked');
      
      // Lấy id của sản phẩm
      var productId = $(this).attr('id').replace('customSwitch31', '');
      
      // Xây dựng URL với các thông tin cần thiết
      var url = 'index.php?action=productList&act=unactive&productId=' + productId;
      
      // Chuyển hướng đến URL tương ứng
      window.location.href = url;
    });
  });
</script>
<style>
  .table td {
  text-align: center; 
  vertical-align: middle; 
}

</style>