<?php
class Productfilter{
    function getAllCategories()
    {
        $db = new connect();
        $select = 'SELECT c.category_id, c.category_name, COUNT(p.product_id) AS productqty_of_category FROM categories c JOIN products p ON c.category_id = p.category_id GROUP BY c.category_id, c.category_name;';
        $result = $db->getList($select);
        return $result;
    }
}
?>