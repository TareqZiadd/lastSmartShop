<?php

class CheckoutModel {

private $db;


function __construct(){
$this->db =  new Database (); 
}

function insertData($data) {
    // Define the SQL query with placeholders
    $query = 'INSERT INTO orders_test (total_amount, shipping_address, user_id) 
              VALUES (:total_amount, :shipping_address, :user_id)';
    
    // Prepare the query
    $this->db->query($query);
    
    // Bind the values from the $data array to the placeholders
    $this->db->bind(':total_amount', $data['total_amount']);
    $this->db->bind(':shipping_address', $data['shipping_address']);
    $this->db->bind(':user_id', $data['user_id']);
    
    // Execute the query
    return $this->db->execute();
}





}
