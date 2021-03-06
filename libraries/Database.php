<?php
  class Database{
  	//Constante definite in config.php
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;  //db handeler to interact with Data Base
    private $error; //to output errors.
    private $stmt;  //used for prepared statemnts.
 
    public function __construct(){ //ruleaza de fiecare data cand facem new DB object.
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT=> true, //cand facem un new object sa avem diferite interactiuni cu el
            PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
  
    public function query($query){
    $this->stmt = $this->dbh->prepare($query);
   }


   public function bind($param, $value, $type = null){
    if (is_null($type)) {
        switch (true) {
           case is_int($value):
            $type = PDO::PARAM_INT;
          break;
           case is_bool($value):
            $type = PDO::PARAM_BOOL;
          break;
           case is_null($value):
           $type = PDO::PARAM_NULL;
          break;
         default:
          $type = PDO::PARAM_STR;
        }
      }
   $this->stmt->bindValue($param, $value, $type);
  }

   //executa ce statement avem
   public function execute(){
    return $this->stmt->execute();
  }

 
  //grab on the result object
  public function resultset(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
 }

  //din result object ia un singur rezultat(ex. topic cu id=1)
  public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
 }


  //numarul de randuri intoarse
  public function rowCount(){
    return $this->stmt->rowCount();
 }
 
  //ne da Id-ul ultim inserat
  public function lastInsertId(){
    return $this->dbh->lastInsertId();
}






}



?>