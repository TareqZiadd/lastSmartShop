<?php


class Cart {
private $db;

public function __construct(){
    $this->db = new Database();
}
function getAllBySessionId($id) {
    $query = 'SELECT `cart_test`.*, `products_test`.*
    FROM `cart_test`
    JOIN `products_test` ON `cart_test`.`product_id` = `products_test`.`id`
    WHERE `cart_test`.`user_id` = :user_id';

    $this->db->query($query);   
    $this->db->bind(':user_id', $id);
    $result = $this->db->resultSet(); 
    return $result;
}







/*
function countQuantity($data) {
    $sql = 'SELECT COUNT(quantity) as quantity_count
            FROM cart_test
            WHERE user_id = :user_id AND product_id = :product_id';

$this->db->query($sql);
$this->db->bind(':user_id', $data['user_id']);
$this->db->bind(':product_id', $data['product_id']);

$result = $this->db->execute();
}
*/




//if quantity of products in carts_test table >0 return true and style this card
//where id = & userid=  

function countQuantity($data) {
    $sql = 'SELECT SUM(quantity) as quantity_count
            FROM cart_test
            WHERE user_id = :user_id AND product_id = :product_id';

    $this->db->query($sql);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':product_id', $data['product_id']);

    $this->db->execute();
    
    $result = $this->db->single(); 

    return $result->quantity_count; 
}


function insertData($data) {

$query = 'INSERT INTO cart_test (product_id,user_id,quantity) 
VALUES (:product_id,:user_id,:quantity)';
    
    $this->db->query($query);
        
    $this->db->bind(':product_id', $data['product_id']);

    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':quantity', $data['quantity']);

       
    return $this->db->execute();
}
function updatetData($data) {

    $query = 'INSERT INTO cart_test (product_id,user_id,quantity) 
    VALUES (:product_id,:user_id,:quantity)';
        
        $this->db->query($query);
            
        $this->db->bind(':product_id', $data['product_id']);
    
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':quantity', $data['quantity']);
    
           
        return $this->db->execute();
    }

 

    public function updateProductQuantity($data) {
        $query = 'UPDATE cart_test SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id';
        
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);
        
        return $this->db->execute();
    }
    
    

    function checkOut ($user_id){

            $query = 'SELECT `cart_test`.*, `products_test`.*
                      FROM `cart_test`
                      JOIN `products_test` ON `cart_test`.`product_id` = `products_test`.`id`
                      WHERE `cart_test`.`user_id` = :user_id';
        
            $this->db->query($query);   
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->resultSet(); 
            return $result;
        }


        function totalPrice($user_id) {
            $query = '
                SELECT
                SUM(`cart_test`.`quantity` * `products_test`.`price`) AS `total_amount`
                FROM `cart_test`
                JOIN `products_test` ON `cart_test`.`product_id` = `products_test`.`id`
                WHERE `cart_test`.`user_id` = :user_id';
        
            $this->db->query($query);   
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->single(); 
        
            return $result;
        }
              

        function deleteById($user_id, $product_id) {
            $sql = "DELETE FROM cart_test WHERE user_id = :user_id AND product_id = :product_id";
            $this->db->query($sql);
            $this->db->bind(':user_id', $user_id); 
            $this->db->bind(':product_id', $product_id);
            $this->db->execute();
        }

        function updateQuantity($data) {
            $query = 'UPDATE cart_test 
                      SET quantity = quantity + 1 
                      WHERE user_id = :user_id AND product_id = :product_id';
        
            $this->db->query($query);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':product_id', $data['product_id']);
        
            return $this->db->execute();
        }


        public function insertAddress($shipping_address, $total_amount, $user_id) {
            $query = 'INSERT INTO orders_test (total_amount, user_id, shipping_address) 
                      VALUES (:total_amount, :user_id, :shipping_address)';
            $this->db->query($query);
            $this->db->bind(':total_amount', $total_amount);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':shipping_address', $shipping_address);
            $this->db->execute();
    
            // الحصول على ID الطلب الجديد
            $order_id = $this->db->lastInsertId();
    
            // نقل العناصر من cart_test إلى orders_item
            $this->transferCartToOrderItems($order_id, $user_id);
        }
    
        public function transferCartToOrderItems($order_id, $user_id) {
            // جلب جميع العناصر من cart_test للمستخدم مع السعر
            $query = 'SELECT cart_test.product_id, cart_test.quantity, products_test.price
                      FROM cart_test
                      JOIN products_test ON cart_test.product_id = products_test.id
                      WHERE cart_test.user_id = :user_id';
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $result = $this->db->resultSet();
        
            // إدخال العناصر في orders_item مع السعر
            $query = 'INSERT INTO orders_item (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)';
            $this->db->query($query);
            $this->db->bind(':order_id', $order_id);
        
            foreach ($result as $row) {
                $this->db->bind(':product_id', $row->product_id);
                $this->db->bind(':quantity', $row->quantity);
                $this->db->bind(':price', $row->price); // إدخال السعر
                $this->db->execute();
            }
        
            // مسح البيانات من cart_test بعد النقل
            $this->clearCart($user_id);
        }
        
    
        private function clearCart($user_id) {
            $query = 'DELETE FROM cart_test WHERE user_id = :user_id';
            $this->db->query($query);
            $this->db->bind(':user_id', $user_id);
            $this->db->execute();
        }


        public function updateCartQuantity($data) {
            $this->db->query('UPDATE cart_test SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id');
            $this->db->bind(':quantity', $data['quantity']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->execute();
        }
        
    
        
        



    }
        
             



