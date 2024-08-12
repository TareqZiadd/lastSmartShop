<?php

class Carts extends Controller
{





    public function __construct()
    {

    }

    

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }else{
        header('Location: ' . URLROOT . '/carts/cart_view');
        }
    }
    
    public function cart_view(){
        if (isset($_SESSION['user_id'])) {
            $obj = $this->model('Cart');
            $total = $obj->totalPrice($_SESSION['user_id']);
            $id = $_SESSION['user_id'];
            $result = $obj->getAllBYSessionId($id);
            
            // Check if product_id is set in the POST data
            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
    
            $data = [
                'carts' => $result,
                'product_id' => $product_id, // Use the checked value
                'user_id' => $_SESSION['user_id'],
                'total' => $total->total_amount
            ];    
    
            $this->view('pages/cart', $data);
        } else {
            $this->view('users/login', $data=[]);
        }
    }
    
 
    
    //function quantityNum() {

function insertCart() {
    // Check if POST data and session data exist
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
        $data = [
            'product_id' => $_POST['product_id'],
            'user_id' => $_SESSION['user_id']
        ];
    
        // Create a single instance of Cart
        $obj = $this->model('Cart');
        $quantity_count = $obj->countQuantity($data);
        if($quantity_count == 0) {

            // Add product to cart if not already present
            $data['quantity'] = 1; // Update quantity
            $obj->insertData($data);
            header('Location: ' . URLROOT . '/pages/shop');
        
        } else {

            $obj = $this->model('Cart');
            $obj->updateQuantity($data);
            header('Location: ' . URLROOT . '/pages/shop');

        }
    }
}




public function update (){
    $data = [
        'product_id' => $_POST['product_id'],
        'quantity' => $_POST['quantity'],
        'user_id' => $_SESSION['user_id']
    ];
$obj=$this->model('Cart');
$obj->updateCartQuantity($data);




/*
 public function updateProductQuantity($data) {
        $query = 'UPDATE cart_test SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id';
        
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);
        
        return $this->db->execute();
    }
*/

    
}
  


public function checkOut() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $obj = $this->model('Cart');
        $userId = $_SESSION['user_id'];

        // تحديث الكميات في سلة التسوق
        foreach ($_POST['products'] as $product) {
            $data = [
                'user_id' => $userId,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity']
            ];
            $obj->updateCartQuantity($data);
        }

        // حساب المجموع الكلي وإظهار صفحة الدفع
        $total = $obj->totalPrice($userId);
        $data = ['total' => $total->total_amount];
        $this->view('pages/checkout', $data);
    }
}



/*
public function checkOut() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $obj = $this->model('Cart');
    $total = $obj->totalPrice($_SESSION['user_id']);
    
  $data=['total'=>$total->total_amount];

    
$this->view('pages/checkout',$data);
       
}}
*/





/*
public function checkOut() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . URLROOT . '/users/login');
        exit();
    }
    if($_SERVER['METHOD_REQUEST']=='POST'){
    $obj = $this->model('Cart');
    $total = $obj->totalPrice($_SESSION['user_id']);
    
  $data=['total'=>$total->total_amount];

    
$this->view('pages/checkout',$data);
       
}


*/
public function delById($product_id)
{
    
    $obj = $this->model('Cart');
    $user_id = $_SESSION['user_id'];

    // Delete the product by ID
    $obj->deleteById($user_id, $product_id);

    // Redirect to the cart view
    header('Location: ' . URLROOT . '/carts/cart_view');
    exit();
}




    
    
        
     

       function insertAdress() {
        print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            
            $obj = $this->model('Cart'); 
            $shipping_address = $_POST['shipping_address'];
            $user_id = $_SESSION['user_id'];
            $total_amount=$_POST['total_amount'];
            $obj->insertAddress($shipping_address, $total_amount, $user_id); 
            echo "Address inserted successfully."; 
        }
    }
    


 
}