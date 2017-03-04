<?php require_once('core/init.php');?>
<?php

// Create Topic Object
$topic = new Topic;

// Get Template & Assign Vars
$template = new Template('templates/frontpage.php'); //facem obiectul $template

//Assign Vars: putem folosi $topics in Template:
$template->topics = $topic->getAllTopics(); //functia definita in clasa Topic.

//Statisticile: 
$template->getTotalTopics = $topic->getTotalTopics();
$template->getTotalCategories = $topic->getTotalCategories();
$template->getTotalUsers = $topic->getTotalUsers();
// Display Template: obiectul $template
echo $template; 

?>