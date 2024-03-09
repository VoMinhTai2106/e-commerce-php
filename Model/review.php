<?php
    class review{
        function insertReview($customer_id,$product_id,$review_title,$review_content){
            $db=new connect();
            $query="insert into review(id,customer_id,product_id,review_title,review_content) values(NULL,$customer_id,$product_id,'$review_title','$review_content')";
            echo $query;
            $db->exec($query);
        }
        function selectReview($product_id){
            $db=new connect();
            $select="select a.review_date,a.review_title,a.review_content,b.customer_name from review a, customers b where a.customer_id=b.customer_id and a.product_id=$product_id ORDER BY a.review_date DESC limit 2";
            $result=$db->getList($select);
            return $result;
        }
        function countReviews($id){
            $db=new connect();
            $select="SELECT COUNT(*) AS total_reviews FROM review WHERE product_id = $id;";
            $result=$db->getInstance($select);
            return $result;
        }
    }
?>