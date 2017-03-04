<?php

 // Redirect to Page function
 // $page: pagina catre care facem redirect
  function redirect($page = false, $message = null, $message_type= null){
  	if(is_string($page)){
  		$location = $page;
  	}else{
  		$location = $_SERVER['SCRIPT_NAME']; // Pagina actuala
  	}
  
    // Check for Message: 
    if($message != null){
    	// set message:
    	$_SESSION["message"] = $message;
    }
    // Check for type:
    if($message_type != null){
    	// set message_type:
    	$_SESSION["message_type"] = $message_type;
    }
    // Redirect:
    header('Location: ' .$location);
    exit;

  }
 

  // Display message:
  function displayMessage(){
    if(!empty($_SESSION['message'])){

      // Assign Message var:
      $message = $_SESSION['message'];

      if(!empty($_SESSION['message_type'])){
        $message_type = $_SESSION['message_type'];
        // Create output:
        if($message_type == 'error'){
          echo '<div class="alert alert-danger">' . $message. '</div>';
        }else{
          echo '<div class="alert alert-succes">' . $message. '</div>';
        }
      }
      // Unset message:
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
    }else{
      echo '';
    }
  }
 

 // Check if User is Logged In
 function isLoggedIn(){
  if(isset($_SESSION['is_logged_in'])){
    return true;
  }else{
    return false;
  }
 }

 // Get Logged in user Info:
 function getUser(){
  $userArray = array();
  $userArray['user_id'] = $_SESSION['user_id'];
  $userArray['username'] = $_SESSION['username'];
  $userArray['name'] = $_SESSION['name'];
  return $userArray;
 }


?>