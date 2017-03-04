<?php require_once('core/init.php');?>
<?php
// Create Topic object:
$topic = new Topic;
// Get Template & Assign Vars
$template = new Template('templates/topics.php'); //facem obiectul $template


// Get user from URL / check for user filter:
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

if(isset($user_id)){
	$template->topics = $topic->getByUser($user_id);
	// $template->title = 'Posts by ' . $topic->getUser($user_id)->name.'';
}





// Get Category from URL
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Assign Template Variables:
// Acestea sunt afisate in cazul in care este setata $category in URL
if(isset($category)){
	$template->topics = $topic->getByCategory($category);
	$template->title = 'Posts in ' . $topic->getCategory($category)->name.'';


}
// Daca nu e selectata o categorie si un User:
if(!isset($category) && !isset($user_id)){
	$template->topics = $topic->getAllTopics(); //functia definita in clasa Topic.

}



$template->getTotalTopics = $topic->getTotalTopics();
$template->getTotalCategories = $topic->getTotalCategories();
$template->getTotalUsers = $topic->getTotalUsers();






// Display Template: obiectul $template
echo $template; 

?>