<?php 
class productModel{
    function getAllCategory(){
        {
            $db = new connect();
            $select = 'SELECT * FROM categories';
            $result = $db->getList($select);
            return $result;
        }

    }
    function addProduct($name,$description,$price,$category_id,$stock_quantity,$sale,$default_image_path){
        $db = new connect();
        $select= "INSERT INTO products(name,description,price,category_id,stock_quantity,sale,default_image_path) VALUES ('$name','$description',$price,$category_id,$stock_quantity,$sale,'$default_image_path')";
        $db->exec($select);
        return $db->db->lastInsertId();
    }
    function addProductImage($id,$image_path){
        $db = new connect();
        $select= "INSERT INTO images(product_id,image_path) VALUES ($id,'$image_path')";
        $result = $db->exec($select);
        return $result;
    }
    function checkExists($name){
        $db = new connect();
        $select= "SELECT * from products where name='$name'";
        $result = $db->getList($select);
        return $result;
    }

    function getAllProduct(){
        $db = new connect();
        $select = 'SELECT products.*, categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.category_id order by product_id desc';
        $result = $db->getList($select);
        return $result;
    }
    function ChangeActive($id){
        $db = new connect();
        $query = "UPDATE products SET active = CASE WHEN active = 0 THEN 1 ELSE 0 END WHERE product_id = $id;";
        $result = $db->exec($query);
        return $result;
    }
    function getProductById($id){
        $db = new connect();
        $select = "SELECT * FROM products where product_id = $id";
        $result = $db->getInstance($select);
        return $result;
    }
}
?>