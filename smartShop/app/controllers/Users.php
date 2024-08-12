<?php

class Users extends Controller
{
    public function __construct()
    {
       $this->userModel = $this->model('User');
    }
    public function register()
    { // check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'phone_number' => trim($_POST['phone_number']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'username_err' => '',
                'email_err' => '',
                'phone_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // validate email
           if (empty($data['email'])) {
               $data['email_err'] = 'Please enter email';
           }
           else{

      if($this->userModel->findUserByEmail($data['email'])){
      $data['email_err'] = 'This email is already taken';
}
           }
           if (empty($data['username'])) {
               $data['username_err'] = 'Please enter name';
           }
            if (empty($data['phone_number'])) {
                $data['phone_number_err'] = 'Please enter phone number';
            }
           if (empty($data['password'])) {
               $data['password_err'] = 'Please enter password';
           }elseif (strlen($data['password']) < 6) {
               $data['password_err'] = 'Password should be at least 6 characters';
           }
       if (empty($data['confirm_password'])) {
           $data['confirm_password_err'] = 'Please confirm password';
       } else {
           if ($data['password'] != $data['confirm_password']) {
               $data['confirm_password_err'] = 'Password did not match';
           }
       }

       // make sure error empty
            if (empty($data['email_err']) && empty($data['username_err'])   && empty($data['phone_number_err']) &&  empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //resgister user
                if ($this->userModel->register($data)) {
                    flash('register_success','you are registered and can log in');
                    header('Location: ' . URLROOT . '/users/login');

                }else{
                    die("something went wrong");

                }
            }
            else{
                // load views with error
               $this->view('users/register', $data);
            }
        }else{
          // init data
            $data = [
                'username' => '',
                'email' => '',
                'phone_number' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'email_err' => '',
                'phone_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // load view
            $this ->view('users/register',$data);
        }
    }



    public function login()
    { // check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            //check for user/email
          if($this->userModel->findUserByEmail($data['email'])){
              // user found
          }else{
              // user not found
              $data['email_err'] = 'no user found';
          }
            // make sure error empty
            if (empty($data['email_err']) && empty($data['password_err'])){
                //check and set logged in user
               $loggedIn = $this->userModel->login($data['email'], $data['password']);
               if ($loggedIn) {
                   // create session
                   $this->createUserSession($loggedIn);
               }else{
                   $data['password_err'] = ' password incorrect';
                   $this->view('users/login', $data);
               }
            }
            else{
                // load views with error
                $this->view('users/login', $data);
            }

        }else{
            // init data
   $data=[
    'email' => '',
    'password' => '',
    'email_err' => '',
    'password_err' => '',
];
            // load view
            $this ->view('users/login',$data);
        }
    }
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



}

?>