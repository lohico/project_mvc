<?php
 //date function: sa arate mai bine:
 function formatDate($date){
 	$date = date("F j, Y, g:i a", strtotime($date));
 	return $date;
 }


 function urlFormat($str){
    // Strip white spaces:
 	$str = preg_replace('/\s*/', '', $str);
 	// Convert string all to lowercase:
 	$str = strtolower($str);
 	// URL encode:
 	$str = urlencode($str);
 	return $str;
 }
 
 function is_active($category){
 	if(isset($_GET['category'])){
 		if($_GET['category'] == $category){
 			return 'active';
 		} else{
 			return '';
 		}
 	} else{
 		if($category== null){
 			return 'active';
 		}
 	}
 }



?>