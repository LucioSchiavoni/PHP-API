<?php  

class Usuario{
    private $name;
    private $email;
    private $pwd;
    
    public function __construct($name, $email, $pwd){
        $this->name = $name;
        $this->email = $email;
        $this->pwd = $pwd;
    }

    //Name
      public function getName(){
       return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }
   

//Email
      public function getEmail(){
      return  $this->email;
    }

     public function setEmail($email){
        $this->email = $email;
        return $this;
    }


    //PWD
     public function getPwd(){
        return $this->pwd;
    }

        public function setPwd($pwd){
        $this->pwd = $pwd;
        return $this;
    }

    public function __toString(){
        return $this->name ." ".$this->email." ".$this->pwd;
    }

    public function postUser(){

    }

     public function getUser(){
        
    }

     public function updateUser(){
        
    }
     public function deleteUser(){
        
    }

}


?>