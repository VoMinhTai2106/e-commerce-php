<?php
class product{
    function getAllNewProducts()
    {
        $db = new connect();
        $select = 'SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id ORDER BY p.product_id DESC LIMIT 10;';
        $result = $db->getList($select);
        return $result;
    }
    function getTVNewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = 'TV' ORDER BY p.product_id DESC LIMIT 10";
        $result = $db->getList($select);
        return $result;
    }
    function getLaptopNewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = 'Laptop & Computer'ORDER BY p.product_id DESC LIMIT 10;";
        $result = $db->getList($select);
        return $result;
    }
    function getSmartphoneNewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = 'Smartphone' ORDER BY p.product_id DESC LIMIT 10;";
        $result = $db->getList($select);
        return $result;
    }
    function getSmartWatchNewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = 'Smart Watch' ORDER BY p.product_id DESC LIMIT 10; ";
        $result = $db->getList($select);
        return $result;
    }
    function getAudioNewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_name = 'Audio' ORDER BY p.product_id DESC LIMIT 10;";
        $result = $db->getList($select);
        return $result;
    }
    function getMostViewProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id ORDER BY p.view_count DESC LIMIT 10; ";
        $result = $db->getList($select);
        return $result;
    }
    function getMostSoldQuantityProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id ORDER BY p.sold_quantity DESC LIMIT 10; ";
        $result = $db->getList($select);
        return $result;
    }
    function getNewSaleProducts()
    {
        $db = new connect();
        $select = "SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.sale > 0 ORDER BY p.sale DESC LIMIT 10; ";
        $result = $db->getList($select);
        return $result;
    }
    function getProductDetail($id){
        $db = new connect();
        $select="SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.product_id = $id;";
        // "SELECT p.*, i.image_path FROM products p JOIN images i ON p.product_id = i.product_id WHERE p.product_id = 1;";
        $result =$db->getInstance($select);
        return $result;
    }
    function getImageProduct($id){
        $db = new connect();
        $select="SELECT * from images where product_id = $id";
        $result =$db->getList($select);
        return $result;
    }
    function getrRelateProduct($category_id){
        $db = new connect();
        $select="SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.category_id = $category_id ORDER BY p.product_id DESC LIMIT 4;";
        $result =$db->getList($select);
        return $result;
    }
}

?>