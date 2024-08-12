<?php



class Checkout extends Controller {

function __construct (){

}


public function index (){
    if (!isset($_SESSION['user_id'])){
       header ('location:' .URLROOT. '/users/login');        
        }else{
            $data= [];

        $this->view('/pages/checkout',$data);
        }

}



public function insert (){

    //if($_SERVER['REQUEST_METHOD']=='POST'){

        $data = [
            'total_amount' => '3',
            'shipping_address' => 'amman',
            'user_id' => '1',
            ];
            $obj=$this->model('CheckoutModel');
            $result=$obj->insertData($data);
            var_dump ($result);
            //$this->view('/pages/checkout',$data);
    }

  




}


















