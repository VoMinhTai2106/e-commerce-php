<?php
class invoice
{
    function insertInvoice($customer_id,$receiver,$receive_address,$receiver_phone,$invoice_note)
    {
        // $date = new DateTime('now');
        // $day = $date->format('Y-m-d');
        $db = new connect();
        $query = "insert into invoices (customer_id,invoice_date,subtotal,receiver,receive_address,receiver_phone,invoice_note)
         values($customer_id,NOW(),0,'$receiver', '$receive_address', $receiver_phone,'$invoice_note')";
        $db->exec($query);
        // lấy 
        $select = "select invoice_id from invoices order by invoice_id desc limit 1";
        $invoice_id = $db->getInstance($select);
        return $invoice_id[0];
    }
    function insertInvoiceDetail($invoice_id, $product_id, $quantity, $total)
    {
        $db = new connect();
        $query = "insert into invoicedetails(invoice_id,product_id,quantity,total) values($invoice_id,$product_id,$quantity,$total)";
        // $sql = "INSERT INTO invoicedetails (invoice_id, customer_id, quantity, total) VALUES (?, ?, ?, ?)";
        // // Sử dụng prepared statement
        // if ($stmt = $db->execP($sql)) {
        //     // Gán giá trị vào các tham số
        //     $stmt->bind_param("iiid", $invoice_id, $customer_id, $quantity, $total);
        //     // Thiết lập giá trị cho các biến
        //     $invoice_id = $your_invoice_id; // Giá trị thực của invoice_id
        //     $customer_id = $your_customer_id; // Giá trị thực của customer_id
        //     $quantity = $your_quantity; // Giá trị thực của quantity
        //     $total = $your_total; // Giá trị thực của total
        //     // Thực thi truy vấn
        //     $stmt->execute();
        //     // Đóng prepared statement
        //     $stmt->close();
        // } else {
        //     // Xử lý lỗi nếu prepare không thành công
        //     echo "Lỗi: " . $mysqli->error;
        // }
        $db->exec($query);
    }
    function updateInvoicesSubtotal($invoice_id,$custommer_id,$subtotal){
        $db=new connect();
        $query="update invoices set subtotal=$subtotal where customer_id=$custommer_id and invoice_id=$invoice_id";
        $db->exec($query);
    }
    function getInvoiceByCustomerId($invoice_id){
        $db= new connect();
        $select="select b.invoice_id,b.invoice_date,a.customer_name,a.customer_address,a.phone from customers a 
        inner join invoices b on a.customer_id=b.customer_id where invoice_id=$invoice_id ";
        $result=$db->getInstance($select);
        return $result;
    }
    function getInvoiceDetail($invoice_id){
        $db= new connect();
        $select="select distinct a.name,a.price,c.quantity from products a,invoicedetails c where a.product_id=c.product_id and c.invoice_id=$invoice_id";
        $result=$db->getList($select);
        return $result;
    }
    //update quantity_stock, sold_quantity
    function updateQuantity($invoice_id,$product_id){
        $db= new connect();
        $query="UPDATE products
        SET stock_quantity = stock_quantity - (SELECT quantity FROM invoicedetails WHERE product_id = $product_id AND invoice_id = $invoice_id),
            sold_quantity = sold_quantity + (SELECT quantity FROM invoicedetails WHERE product_id = $product_id AND invoice_id = $invoice_id)
        WHERE product_id = $product_id;
        ";
        $result=$db->exec($query);
        return $result;
    }
}