<?php
class User {
    private $db;
    public function __construct() { // any thing come with Database.php
        $this->db = new Database; // call constructor with database.php
    }

    //register user
    public function register($data) {
        $this->db->query("INSERT INTO users(username, email, phone_number,password) VALUES(:username, :email, :phone_number,:password)");

// to conect data
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':password', $data['password']);


        // to  enshure that Execute stmt in data base file
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    // login user
    public function login($email, $password) {
        $this->db->query("SELECT * FROM users WHERE email = :email ");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        $hashedPassword = $row->password;
        if(password_verify($password, $hashedPassword)) {
            return $row;
        }else{
            return false;
        }

    }
    // find user by email
    public function findUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row= $this->db->single();
        // check row
        if($this->db->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }



    public function getUserById($id) {
        $this->db->query('SELECT `cart_test`.*, `products_test`.`description`
        FROM `cart_test`
        JOIN `products_test`
        ON `cart_test`.`product_id` = `products_test`.`id`
        WHERE `cart_test`.`user_id` = :id');
        $this->db->bind(':id', $id);
        $row =$this->db->resultSet();
        return $row;


    }
}
