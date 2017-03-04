<?php
//Template Class. Creates a template/view object


class Template{
  //Path to template
	protected $template;

	protected $vars = array(); //sa pasam valori catre Template chiar si din DB.

	//Class constructor
	 public function __construct($template) { //de fiecare data cand facem o clasa adaugam Pathul catre Templateul nostru catre noua clasa
		$this->template = $template;
	}

    //Get template variables
    public function __get($key) {
    	return $this->vars($key);//scoate numai valoarea
    }


    //Set template variables
    public function __set($key, $value) {
    	 $this->vars[$key] = $value;
    }
  
    //Convert Object to String
    public function __toString() {
    	extract($this->vars);  //sa luam variabilele Templetului
    	chdir(dirname($this->template));
    	ob_start(); //creates a buffer which output is written to.

    	include basename($this->template);  //includem Templetul in fisierul dat.

    	return ob_get_clean();   //object flush/ sterge buffer

    } //ne lasa sa tratam Obj ca un string si putem sa facem echo Templetului.
}