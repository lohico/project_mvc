<?php //nu adaugam Template pt ca se face Logout si redirect?>
<?php include('core/init.php'); ?>
<?php
 
  if(isset($_POST['do_logout'])){
  	
  	// Create User Object:
  	$user = new User;
    $message = "";
  	if($user->logout($message)){
  		redirect('index.php', 'You have been logged out '. $message, 'success');
  	}
  }else{
  	redirect('index.php');
  }



?>