<?php
    if(isset($_POST['submit'])){
        $customer_id= $_SESSION['user']['customer_id'];
        echo $customer_id;
        $product_id=$_POST['txtProductId'];
        echo $product_id;
        $review_content=$_POST['content'];
        echo $review_content;
        $review_title=$_POST['txtReviewTitle'];
        $review=new review();
        $review->insertReview($customer_id,$product_id,$review_title,$review_content);
    }
    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=productinfo&id='.$product_id.'"/>';
?>