<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    // Load model
    public function model($model){ // $model = User
      // Require model file
      require_once '../app/models/' . $model . '.php';

      // Instatiate model
      return new $model();
    }

    // Load view
      // this function to check if view exist or not
    public function view($view, $data = []){

      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){ //  $view = pages /(about or index)
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
  }