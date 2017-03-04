<?php require_once('core/init.php');?>
<?php
// Create topic object
$topic = new Topic;
// Create user object:
$user = new User;
// Create Validator object:
$validate = new Validator;
// Get Template & Assign Vars
$template = new Template('templates/register.php'); //facem obiectul $template


 // Daca e apasat Butonul de Register:
if(isset($_POST['register'])){
	// Create Data array:
	$data = array();
	$data['name'] = $_POST['name'];
	$data['email'] = $_POST['email'];
	$data['username'] = $_POST['username'];
	$data['password'] = md5($_POST['password']);
	$data['password2'] = md5($_POST['password2']);
	$data['about'] = $_POST['about'];
	$data['last_activity'] = date("Y-m-d H:i:s");

	// Creatde fields to be required: sunt acelea din POST
	$field_array = array('name', 'email', 'username', 'password', 'password2');

	if($validate->isRequired($field_array)){
       if($validate->isValidEmail($data['email'])){
         if($validate->passwordMatch($data['password'], $data['$password2'])){
            
             // Avatar upload:
               if($user->uploadAvatar()){ // din cauza asta am pus acolo : return True
                    $data['avatar'] = $_FILES["avatar"]["name"];
                  }else{
                    $data['avatar'] = 'noimage.png';
                    }

        // Register User:
                if($user->register($data)){
                    redirect('index.php', 'You are register and now you can log in', 'succes');
                  }else{
 	               redirect('index.php', 'Something went wrong with registration', 'error');
                  }


         }else{
         	redirect('register.php', 'Your passwords did not match', 'error');
         }
       }else{
       	redirect('register.php', 'Your email is not a valid email address', 'error');
       }

	}else{
		redirect('register.php', 'Your required* fields are empty', 'error');
	}

   
}
   






$template->getTotalTopics = $topic->getTotalTopics();

//Display Template: obiectul $template
echo $template; 

?>