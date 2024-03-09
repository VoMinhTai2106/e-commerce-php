<?php
class user {
    //phườn thức kiểm tra username và email có tồn tại hay không

    function getCheckUser($username, $email) {
        $db = new connect();
        $select = 'SELECT a.username, a.customer_email FROM customers a WHERE a.username = "' . $username . '" OR a.customer_email = "' . $email .'"';
        $result = $db->getList($select);
        return $result;
    }

    function insertCustomer($data) {
        $db = new connect();
        $customerName = $data['customerName'];
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $query = "INSERT INTO customers (customer_id, customer_name, username,password, customer_email, customer_address, phone)
         VALUES (NULL, '$customerName', '$username', '$password', '$email', '$address', '$phone')";
        $result = $db->exec($query);
        return $result;
    }
    function logCustomer($username, $password)
    {
        $db = new connect();
        $select = 'select * from customers WHERE username="' . $username . '" and password="' . $password . '"';
        $result = $db->getInstance($select);
        return $result;
    }
}
