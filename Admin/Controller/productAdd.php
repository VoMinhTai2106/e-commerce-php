<?php
$act = $_GET['act'] ?? ''; // Sử dụng Null Coalescing Operator

$connect = new connect();

switch ($act) {
    case 'add':
        handleAddProduct();
        break;
    default:
        include_once "./View/ProductManage/AddProduct.php";
        break;
}

function handleAddProduct()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        include_once "./View/ProductManage/AddProduct.php";
        return;
    }
    $name = $_POST['addProductName'] ?? "";
    $category_id = $_POST['addProductCategory'] ?? "";
    $price = $_POST['addProductPrice'] ?? "";
    $sale = $_POST['addProductSale'] ?? "";
    $stock_quantity = $_POST['addProductQty'] ?? "";
    $description = $_POST['addProductDes'] ?? "";
    $default_image_path = $_FILES['addProductDefaultImage']['name'] ?? "";

    $product = new productModel();

    $lastInsertId = $product->addProduct($name, $description, $price, $category_id, $stock_quantity, $sale, $default_image_path);
    $image_directory = getImageDirectory();
    handleDefaultImageUpload($image_directory, $lastInsertId);
    handleOtherImageUpload($image_directory, $lastInsertId);
    echo '<script>alert("Add product successfully");</script>';
    include_once "./View/ProductManage/AddProduct.php";
}

function getImageDirectory()
{
    $controller_directory = dirname(__FILE__);
    $root_directory = realpath($controller_directory . '/../../');
    return $root_directory . '/content/images/products/';
}

function handleDefaultImageUpload($image_directory, $lastInsertId)
{
    $target_file = $image_directory . basename($_FILES["addProductDefaultImage"]["name"] ?? "");
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["addProductDefaultImage"]["tmp_name"]);
        if ($check === false) {
            echo '<script>alert("File is not an image.");</script>';
            $uploadOk = 0;
        }
    }

    if ($_FILES["addProductDefaultImage"]["size"] > 5000000) {
        echo '<script>alert("Sorry, your file is too large.");</script>';
        $uploadOk = 0;
    }

    $allowed_image_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_image_types)) {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.");</script>';
    } else {
        if (move_uploaded_file($_FILES["addProductDefaultImage"]["tmp_name"], $target_file)) {
            echo "<script>alert(The file " . htmlspecialchars(basename($_FILES["addProductDefaultImage"]["name"])) . " has been uploaded.);</script>";
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
        }
    }
}

function handleOtherImageUpload($image_directory, $lastInsertId)
{
    $other_images = [];
    $error_messages = [];

    if (!isset($_FILES['addProductImages'])) {
        return;
    }

    foreach ($_FILES['addProductImages']['name'] as $index => $filename) {
        $tmpFilePath = $_FILES['addProductImages']['tmp_name'][$index];
        if ($tmpFilePath != "") {
            $newFilePath = $image_directory . basename($filename);
            $imageFileType = strtolower(pathinfo($newFilePath, PATHINFO_EXTENSION));

            $check = getimagesize($tmpFilePath);
            if ($check === false) {
                $error_messages[] = "File '$filename' is not an image.";
                continue; // Skip to the next file
            }

            if ($_FILES['addProductImages']['size'][$index] > 5000000) {
                $error_messages[] = "File '$filename' is too large.";
                continue; // Skip to the next file
            }

            $allowed_image_types = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowed_image_types)) {
                $error_messages[] = "File '$filename' is not allowed. Only JPG, JPEG, PNG & GIF files are allowed.";
                continue; // Skip to the next file
            }

            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $other_images[] = $filename;
            } else {
                $error_messages[] = "Error uploading file '$filename'.";
            }
        }
    }
    // Print out error messages, if any
    if (!empty($error_messages)) {
        echo '<script>alert("Error(s) occurred while uploading images:\n' . implode('\n', $error_messages) . '");</script>';
    }

    // Insert other images into database
    $product = new productModel();
    foreach ($other_images as $image_path) {
        $product->addProductImage($lastInsertId, $image_path);
    }
}
