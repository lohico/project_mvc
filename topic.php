<?php require_once('core/init.php');?>
<?php
// Create topic object:
$topic = new Topic;
// Create User object:
$user = new User;

// Get id from URL -- acum lucram cu un post individual:
$topic_id = $_GET['id'];



 if(isset($_POST['do_reply'])){
      // Set array data:
 	$data = array();
 	$data['topic_id'] = $_GET['id']; // luam id-ul din URL
 	$data['user_id'] = getUser()['user_id'];
 	$data['body'] = $_POST['body'];
 	
 	// Create validate object:
 	$validate = new Validator;
    // Required Fields:
    $field_array = array('body');

    if($validate->isRequired($field_array)){
    	// Register Reply
    	if($topic->reply($data)){
    		redirect('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
    	}else{
            redirect('topic.php?id='.$topic_id, 'Something went wrong', 'error');
    	} 
    }else{
    	redirect('topic.php?id='.$topic_id, 'Your reply form is blank', 'error');
    }
 }


// Get Template & Assign Vars
$template = new Template('templates/topic.php'); //facem obiectul $template

// Views:
     if(isset($topic_id)){
     	$template->visits = $topic->views($topic_id)->visits;
     }
	 
// Delete Reply:
     if(isset($_POST['do_delete']) and isset($topic_id)){

      if($topic->delete_reply($topic_id)){
      	redirect('topic.php?id='.$topic_id, 'The reply has been deleted', 'success');
      }
 }




 
 if(isset($_POST['edit_topic']) and !empty($_POST['body'])){
      // Set array data:
    $data = array();
    $data['topic_id'] = $_GET['id']; // luam id-ul din URL
    $data['body'] = $_POST['body'];
    
        if($topic->update_topic($data)){
            redirect('topic.php?id='.$topic_id, 'Your topic has been modify', 'success');
        }else{
            redirect('topic.php?id='.$topic_id, 'Your body form is ok', 'error');
        } 
 } 

 if(isset($topic_id)){
       
       $template->replies = $topic->Replies($topic_id);
}




// Assign vars:
$template->topic = $topic->getTopic($topic_id);
// $template->replies = $topic->getReplies($topic_id);
$template->title = $topic->getTopic($topic_id)->title;


$template->getTotalTopics = $topic->getTotalTopics();

// Display Template: obiectul $template
echo $template; 

?>