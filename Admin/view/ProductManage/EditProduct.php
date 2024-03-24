<?php $product = new productModel();
$result = $product->getProductById($_GET['productId']); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primar mt-2">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Edit product: <?php echo $result['name'] ?> </h3>
                </div>
                <form action="index.php?action=productEdit&act=edit" enctype="multipart/form-data" method="post">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-8">
                                <label for="addProductName">Product Name</label>
                                <input type="text" value="<?php echo $result['name'] ?>" class="form-control" id="addProductName" name="addProductName" placeholder="Product Name" required>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control select2" style="width: 100%;" name="addProductCategory">
                                        <?php
                                        $categories = $product->getAllCategory();
                                        while ($set = $categories->fetch()) :
                                            $selected = ($set['category_id'] == $result['category_id']) ? "selected" : "";
                                        ?>
                                            <option value="<?php echo $set['category_id']; ?>" <?php echo $selected; ?>><?php echo $set['category_id']; ?>--<?php echo $set['category_name']; ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-4">
                                <label for="addProductPrice">Price</label>
                                <input type="number" value="<?php echo $result['price'] ?>" min="0" class="form-control" id="addProductPrice" name="addProductPrice" placeholder="Product Price" required>
                            </div>
                            <div class="col-4">
                                <label for="addProductQty">Quantity</label>
                                <input type="number" value="<?php echo $result['stock_quantity'] ?>" min="0" class="form-control" id="addProductQty" name="addProductQty" placeholder="Product Quantity" required>
                            </div>
                            <div class="col-4">
                                <label for="addProductSale">Sale</label>
                                <input type="number" value="<?php echo $result['sale'] ?>" min="0" max="100" class="form-control" id="addProductSale" name="addProductSale" placeholder="Product Sale" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="summernote">Description</label>
                            <textarea id="summernote" name="addProductDes" required><?php echo $result['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addProductDefaultImage">Default Image</label>
                            <input type="file" class="form-control" id="addProductDefaultImage" name="addProductDefaultImage">
                            <div id="product-preview">
                                <?php if (!empty($result['default_image_path'])) : ?>
                                    <img src="/content/images/products/<?php  echo $result['default_image_path']; ?>" alt="" height="200px">
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="addProductImages">Other Images</label>
                            <input type="file" class="form-control" id="addProductImages" name="addProductImages[]" multiple required>
                            <div id="other-images-preview"></div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    const productPreview = document.getElementById('product-preview');
    const addProductDefaultImage = document.getElementById('addProductDefaultImage');

    addProductDefaultImage.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                img.src = e.target.result;
                productPreview.innerHTML = '';
                productPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    const otherImagesPreview = document.getElementById('other-images-preview');
    const addProductImages = document.getElementById('addProductImages');

    addProductImages.addEventListener('change', function(event) {
        const files = event.target.files; // Get all selected files

        otherImagesPreview.innerHTML = ''; // Clear existing previews

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.startsWith('image/')) {
                alert(`"${file.name}" is not a valid image file. Please select only images.`);
                continue; // Skip non-image files
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.style.width = '200px';
                img.style.height = '100px';
                img.src = e.target.result;
                otherImagesPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>