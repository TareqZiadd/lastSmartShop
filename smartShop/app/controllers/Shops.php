<?php

class Shops extends Controller
{
    private $shopModel;
    public function __construct()
    {
        $this->shopModel = $this->model('Shop');
    }


    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),

                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'quantity' => trim($_POST['quantity']),
                'category_id'=> trim($_POST['category']),
                // image
                // 'user_id' => $_SESSION['user_id'],
                'name_err' => '',
                'price_err' => '',
                'description-err' => '',
                'quantity_err' => '',
            ];
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description text';
            }
            if (empty($data['quantity'])) {
                $data['quantity_err'] = 'Please enter quantity';
            }
            // make sure not error
            if (empty($data['name_err']) && empty($data['price_err']) && empty($data['quantity_err'])&& empty($data['description_err'])) {
                if ($this->shopModel->addproduct($data)) {
                    //flash('Product_message', 'product Added');
                    redirect('shop');
                } else {
                    die("something went wrong");

                }
            } else {
                // load views with error
                $this->view('product/add', $data);
            }
        } else {
            $data = [
                'name' => '',
                'price' => '',
                'description' => '',
                'quantity' => '',
                'category' => ''
            ];
            $this->view('product/add', $data);
        }
    }







}