<?php require_once('core/init.php');?>
<?php
// Create Topic Object
$topic = new Topic;

// Get Template & Assign Vars
$template = new Template('templates/create.php'); //facem obiectul $template

 if(isset($_POST['do_create'])){
    // Create a Validator Object
    $validate = new Validator;

 	// Set data Array:
 	$data = array();
 	$data['title'] = $_POST['title'];
 	$data['body'] = $_POST['body'];
 	$data['category_id']= $_POST['category']; // Cand selecteaza o categorie primim un category_id(setata value)
 	$data['user_id'] = getUser()['user_id']; // Informatii despre cine a facut Topicul
 	$data['last_activity'] = date("Y-m-d H:i:s");
 	$data['visits'] = 0;

    // Array cu campurile de validat
 	$field_array = array('title', 'body', 'category');
      
 	if($validate->isRequired($field_array)){
         //Create Topic 
 		if($topic->create($data)){
 			redirect('index.php', 'Your topic has been post', 'succes');
 		}else{
 			redirect('topic.php?id='.$topic_id, 'Something went wrong', 'error');
 		}
 	}else{
           redirect('create.php', 'Please fill all the fileds', 'error');
 	}
 }






// Dispaly total Topics-statistica
$template->getTotalTopics = $topic->getTotalTopics();
// Display Template: obiectul $template
echo $template; 

?>