<?php
  class Pages extends Controller {


    /*
 public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_phone'] = $user->phone_number;
        header('Location: ' . URLROOT . '/pages/shop');

    }
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
    */

    public function __construct(){
        $this->shopModel = $this->model('Shop');
    }
    



    public function contact() {

        print_r($_POST);
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Check for user ID in session
            $sessionVariable = $_SESSION['user_id'] ?? "";
            
            $data = [
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'message' => trim($_POST['message']),
                'user_id' => $sessionVariable,
                'full_name_err' => '',
                'email_err' => '',
                'subject_err' => '',
                'message_err' => ''
            ];
    
            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Please enter your full name';
            } elseif (strlen($data['full_name']) < 7) {
                $data['full_name_err'] = 'Full name must be at least 7 characters';
            } elseif (strlen($data['full_name']) > 100) {
                $data['full_name_err'] = 'Full name must not exceed 100 characters';
            } elseif (!preg_match('/^[a-zA-Z]+\s[a-zA-Z]+/', $data['full_name'])) {
                $data['full_name_err'] = 'Full name must contain at least one space and letters only';
            }
            
    
            // Validate email: must contain @ and end with .com
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || !preg_match('/@.*\.com$/', $data['email'])) {
                $data['email_err'] = 'Please enter a valid email address ending with .com';
            }
    
            // Validate subject: must not exceed 20 characters
            if (empty($data['subject'])) {
                $data['subject_err'] = 'Please enter the subject';
            } elseif (strlen($data['subject']) < 5) {
                $data['subject_err'] = 'Subject must be at least 5 characters long';
            } elseif (strlen($data['subject']) > 25) {
                $data['subject_err'] = 'Subject must not exceed 25 characters';
            }
    
            // Validate message: must be at least 10 characters
            if (empty($data['message'])) {
                $data['message_err'] = 'Please enter the message';
            } elseif (strlen($data['message']) < 10) {
                $data['message_err'] = 'Message must be at least 10 characters';
            } elseif (strlen($data['message']) > 500) {
                $data['message_err'] = 'Message must not exceed 500 characters';
            }
            
    
            // Check if all errors are empty
            if (empty($data['full_name_err']) && empty($data['email_err']) &&
                empty($data['subject_err']) && empty($data['message_err'])) {
    
                $userModel = $this->model('ContactUs');
                $userModel->contactInfo($data);
    
                $this->view('pages/index', $data);
            } else {
                $this->view('pages/contact', $data);
            }
        } else {
            // Load the contact form if the request is not POST
            $data = [];
            $this->view('pages/contact', $data);
        }
    }
    
    


    public function index(){
       //session_start ();   //not nessecary from other 
        print_r ($_SESSION['user_id']);

      $data = [];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [];

      $this->view('pages/about', $data);
    }
    
      public function blog(){
          $data = [];

          $this->view('pages/blog', $data);
      }public function shop() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/users/login');
            exit();
        }
    
        $shop = $this->model('Shop');
    
        
        $data = [
            'shops' => $shop->getProduct(['user_id' => $_SESSION['user_id']]) // تأكد من تطابق اسم الأسلوب مع ما هو في النموذج
        ];
            var_dump($data);
        $this->view('pages/shop', $data);
    }
    

      public function cart(){
        //Go to the () controller 
          header('Location: ' . URLROOT . '/carts/cart_view');
        }
      public function checkout(){
          $data = [];

          $this->view('pages/checkout', $data);
      }



      public function add()
      {

          if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {

              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                  'name' => trim($_POST['name']),
                  'price' => trim($_POST['price']),
                  'description' => trim($_POST['description']),
                  'quantity' => trim($_POST['quantity']),
                  //'image_url' => trim($_POST['image_url']),
                  'category_id'=> trim($_POST['category']),
                  'name_err' => '',
                  'price_err' => '',
                  'description-err' => '',
                  'quantity_err' => '',
              ];

//              if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
//                  $data['image_url'] = $this->uploadFile($_FILES['image_url']);
//              }
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
                     // redirect('shop');
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
                  //'image_url'=>'',
                  'category' => ''
              ];
              $this->view('product/add', $data);
          }
      }


//      public function uploadFile($file) {
//          $uploadDir = 'uploads/';
//          $uploadFile = $uploadDir . basename($file['name']);
//
//          if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
//              return $uploadFile;
//          } else {
//              return null;
//          }
//      }
  }