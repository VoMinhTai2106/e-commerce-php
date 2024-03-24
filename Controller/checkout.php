<?php
$act = "checkout";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'checkout';
        include_once('./View/checkout.php');
        break;
    case 'checkout_successful':
        $invoice = new invoice();
        if (isset($_SESSION['user']['customer_id'])) {
            $customer_id = $_SESSION['user']['customer_id'];
            $receiver=$_POST['receiver'];
            $receive_address=$_POST['receive_address'];
            $receiver_phone=$_POST['receiver_phone'];
            $invoice_note=$_POST['invoice_note'];
            $invoice_id = $invoice->insertInvoice($customer_id,$receiver,$receive_address,$receiver_phone,$invoice_note);
            $_SESSION['invoice_id'] = $invoice_id;
            $subtotal = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
                $invoice->insertInvoiceDetail($invoice_id, $item['id'], $item['quantity'], $item['last_price']);
                $subtotal += $item['last_price'];
                $invoice->updateQuantity($invoice_id,$item['id']);
            }

            $invoice->updateInvoicesSubtotal($invoice_id, $customer_id, $subtotal);
            echo '<script>alert(Order successful) </script>';
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=home"/>';
            $_SESSION['cart']=[];
        }   

        break;
    default:
    include_once('./View/checkout.php');
    break;
}
