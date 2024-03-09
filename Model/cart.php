<?php 
class cart {
    function addCart($id,$quantity) {
        // thiếu hình tên đơn giá thành tiền
        $product = new product();
        $sp = $product->getProductDetail($id);
        $name = $sp['name'];
        $sale=$sp['sale'];
        $img=$sp['default_image_path'];
        $stock_qty=$sp['stock_quantity'];
        if ($sale>0) {
            $price = ($sp['price']*$sale)/100;
        }else{
            $price = $sp['price'];
        }
            $total = $quantity * $price;
        $flag = false;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                $flag=true;
                $quantity += $_SESSION['cart'][$key]['quantity'];
                $this->updateProduct($key, $quantity);// giohang::updateProduct($key, $quantity);
            }
        }
        if ($flag == false) { 
            // tạo đối tượng
            $item = array(
                'id' => $id,
                'name' => $name,
                'quantity' => $quantity,
                'stock_qty'=>$stock_qty,
                'price' => $price,
                'last_price' => $total,
                'img'=>$img,
            );

            //add đối tượng vào giỏ hàng a
            $_SESSION['cart'][] = $item;
        }
    }

    function updateProduct($id, $quantity) {
        $index = $this->findProductIndex($id);
        echo 'index'.$index;
        if ($index !== false) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$index]);
            } else {
                $_SESSION['cart'][$index]['quantity'] = $quantity;
                echo $_SESSION['cart'][$index]['quantity'];
                $last_price_new = $quantity * $_SESSION['cart'][$index]['price'];
                $_SESSION['cart'][$index]['last_price'] = $last_price_new;
            }

        }
    }

     function findProductIndex($id) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($key == $id) {
                return $key;
            }
        }
        return false;   
    }
    function subTotal() {
        $subtotal = 0;
        if(isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']as $item) {
            $subtotal += $item['last_price'];
        }
        $subtotal = number_format($subtotal, 2);
        return $subtotal;}
    }
}