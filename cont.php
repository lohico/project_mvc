<?php require_once('core/init.php');?>
<?php

// Create Topic Object
$topic = new Topic;
// Create User Object
$user = new User;
// Luam id-ul setat in Get:
$user_id = $_GET['id'];


// Get Template & Assign Vars
$template = new Template('templates/cont.php'); //facem obiectul $template




// // Luam toate topicurile by user
// $template->user_topics = $topic->getByUser($user_id);


// // Selectare id topic in functie de user
// $template->user_topic_id = $topic->getTopic_id($user_id);





//Assign Vars: putem folosi $topics in Template:
$template->topics = $topic->getAllTopics(); //functia definita in clasa Topic.

//Statisticile: 
$template->getTotalTopics = $topic->getTotalTopics();
$template->getTotalCategories = $topic->getTotalCategories();
$template->getTotalUsers = $topic->getTotalUsers();
// Display Template: obiectul $template
echo $template; 

?>