<?php
 class Validator{

   // Function fields to be required:
 	public function isRequired($field_array){
 		foreach($field_array as $field){
 			if($_POST[''.$field.''] == ''){
 				return false;
 			}
 		}
             return true;
 	}


 	// Validate email
 	public function isValidEmail($email){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          return true;
        } else {
          return false;
        }
  }

 	// Password Match 
 	public function passwordMatch($psw1, $psw2){
      if($psw1 == $psw2){
      	return true;
      }
      else {
      	return false;
      }
 	}
  
  

 }

























?>