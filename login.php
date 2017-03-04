<?php //nu adaugam Template pt ca se face Login si redirect. Sunt pagini de functionalitate?>
<?php include('core/init.php'); ?>
<?php
 
  if(isset($_POST['do_login'])){

  	$username = $_POST['username'];
  	$password = md5($_POST['password']);

    //create user object:
    $user = new User;
  	if($user->login($username, $password)){
  		redirect('index.php', 'You have been logged in', 'success');

  	}else{
  		redirect('index.php', 'That login is not valid', 'error');
  	}
  	

  }else{
  	redirect('index.php');
  }






?>