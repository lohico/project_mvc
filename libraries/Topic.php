<?php
// fetch Topic, categories, add replies etc:

class Topic{
  // init DB Variable:
  private $db;

  public function __construct(){
    $this->db = new Database;
  }
 

  // Function Get All Topics:  
  // ON topics.user_id = users.id pe ce relatie unim cele 2 tabele(foreign key)
  // topics.*, users.username, etc : ce campuri avem nevoie

  public function getAllTopics(){
  	$this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
  		                     INNER JOIN users
  		                     ON topics.user_id = users.id
  		                     INNER JOIN categories
  		                     ON topics.category_id = categories.id
  		                     ORDER BY create_date DESC 
  		                     ");
  	// Assign Result Set:
  	$results = $this->db->resultset();

  	return $results;

  }
  

  //Get total number of Topics:
  public function getTotalTopics(){
    $this->db->query('SELECT * FROM topics');
    $rows = $this->db->resultset();
    return $this->db->rowCount();
  }

  //Get total number of Categories:
  public function getTotalCategories(){
    $this->db->query('SELECT * FROM categories');
    $rows = $this->db->resultset();
    return $this->db->rowCount();
  }

  //Get total number of users:
  public function getTotalUsers(){
    $this->db->query('SELECT * FROM users');
    $rows = $this->db->resultset();
    return $this->db->rowCount();
  }

 // Get total number of replies:
  public function getTotalReplies($topic_id){
    $this->db->query('SELECT * FROM replies WHERE topic_id= :topic_id');
    $db->bind(':topic_id', $topic_id);
    $rows = $this->db->resultset();
    return $this->db->rowCount();
  }


  //   ======== || ======= //
  // Selectare in functie de id-ul din URL la categorie:


 // Get category: cand e setat category id in URL:
  public function getCategory($category_id){
    $this->db->query('SELECT * FROM categories WHERE id= :category_id');
    $this->db->bind(':category_id', $category_id);

    // Assign row:
    $row = $this->db->single();
    return $row;
  }
 
 // Get by category: cand e setat category id in URL:
 // Se face selectia topics.category_id = :category_id dupa o singura categorie
 public function getByCategory($category_id){
  $this->db->query('SELECT topics.*, categories.*, users.username, users.avatar FROM topics
                           INNER JOIN categories
                           ON topics.category_id = categories.id
                           INNER JOIN users
                           ON topics.user_id = users.id
                           WHERE topics.category_id = :category_id
                           ');
  $this->db->bind(':category_id', $category_id);

  // Assign result set:
  $results = $this->db->resultset();
  return $results;
 }

  

  //   ======== || ======= //
  // Selectare in functie de id-ul din URL la topic:


 // Get Topic by id from url:
 public function getTopic($topic_id){
  $this->db->query('SELECT topics.*, users.username, users.name, users.avatar FROM topics
                           INNER JOIN users
                           ON topics.user_id = users.id
                           WHERE topics.id = :topic_id
                            ');
  $this->db->bind(':topic_id', $topic_id);

  // Assign row:
  $row = $this->db->single();
  return $row;
 }




 // Get replies by id-topic:
 public function getReplies($topic_id){
  $this->db->query('SELECT replies.*, users.* FROM replies
                           INNER JOIN users
                           ON replies.user_id = users.id
                           WHERE replies.topic_id = :topic_id
                           ORDER BY create_date ASC
                           ');
  $this->db->bind(':topic_id', $topic_id);
  // Assign result set:
  $results= $this->db->resultset();
  return $results;
 }


  //   ======== || ======= //
  // Selectare in functie de user-ul din URL la topic:

  public function getByUser($user_id){
    $this->db->query('SELECT topics.*, categories.*, users.username, users.avatar FROM topics
                             INNER JOIN categories
                             ON topics.category_id = categories.id
                             INNER JOIN users
                             ON topics.user_id = users.id
                             WHERE topics.user_id = :user_id
                             ');
    $this->db->bind(':user_id', $user_id);
    // Assign result set:
    $results = $this->db->resultset();
    return $results;

  }


   // == Create TOPIC ==\\

  public function create($data){
    // Insert Query
    $this->db->query('INSERT INTO topics (category_id, user_id, title, body, visits, last_activity)
                      VALUES(:category_id, :user_id, :title, :body, :visits, :last_activity)');

    // Bind Values: cu $data arrayul $_POST
    $this->db->bind(':category_id', $data['category_id']);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':title', $data['title']);
    $this->db->bind(':body', $data['body']);
    $this->db->bind(':visits', $data['visits']);
    $this->db->bind(':last_activity', $data['last_activity']);

    // Execute:
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

 
 /// ========  Create Reply function  ========= \\\ 
 
  public function reply($data){
    // Inserare in tabelul replies:
    $this->db->query('INSERT INTO replies(topic_id, user_id, body)
                          VALUES(:topic_id, :user_id, :body)');

    // Bind values cu cele din $data array
    $this->db->bind(':topic_id', $data['topic_id']);
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':body', $data['body']);
   
    // Execute
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  /// ========  Create Delete_Reply function  ========= \\\ 


  // public function delete_reply($topic_id){
  //   $this->db->query('DELETE FROM replies WHERE topic_id = :topic_id');
  //   $this->db->bind(':topic_id', $topic_id);
  //   $this->db->execute();
  // }

    public function delete_reply($topic_id){
    $this->db->query('DELETE FROM replies WHERE topic_id= :topic_id AND replies.id = replies.id LIMIT 1');
     $this->db->bind(':topic_id', $topic_id);
    $this->db->execute();
  }
 

  /// ========  Create Visits function  ========= \\\ 


 public function views($id){
  $this->db->query("UPDATE topics SET visits=visits + 1 WHERE id=:id");
  $this->db->bind(':id', $id);
  $this->db->execute();

  $this->db->query("SELECT * FROM topics WHERE id= :id");
  $this->db->bind(':id', $id);
  $single = $this->db->single();
  return $single;

 }

 

   //   == Edit Topic button == //


 public function update_topic($data){
  $this->db->query("UPDATE topics SET body= :body WHERE id = :topic_id");
  $this->db->bind(':body', $data['body']); //asta e venit prin POST
  $this->db->bind(':topic_id', $data['topic_id']); //asta e venit prin POST
   // Execute
    $this->db->execute();    
 }
 


// Get Topic by id from url:
 public function getTopic_id($topic_id){
  $this->db->query('SELECT id FROM topics WHERE topics.user_id = :topic_id
                            ');
  $this->db->bind(':topic_id', $topic_id);

  // Assign row:
  $row = $this->db->single();
  return $row;
 }




  public function Replies($topic_id){
  $this->db->query('SELECT replies.id, replies.topic_id, replies.user_id, replies.body, replies.create_date, users.avatar, users.username, users.id FROM replies
                           INNER JOIN users
                           ON replies.user_id = users.id
                           WHERE replies.topic_id = :topic_id
                           ORDER BY create_date ASC
                           ');
  $this->db->bind(':topic_id', $topic_id);
  // Assign result set:
  $results= $this->db->resultset();
  return $results;
 }



 
}


?>