<?php

class userModel{
    public $conn;
    public function __construct(){
        $this->conn = new mysqli('localhost', 'root', '', 'server-test-1');
        mysqli_set_charset($this->conn,'utf8');
    }

//GET *
    public function getUsers($id=null){
    $where = ($id == null) ? "" : " WHERE id='$id' ";
    $users = [];
    $sql= "SELECT * FROM users ".$where;
    $res = mysqli_query($this->conn, $sql);
    while($row = mysqli_fetch_assoc($res)){
        array_push($users,$row);
    }
    return $users;
}

//GET ID
    public function getUsersById($id){
    
    $sql= "SELECT FROM users WHERE id='$id' ";
    $res = mysqli_query($this->conn, $sql);
    return $res;

    return $users;
}

//POST
    public function saveUsers($name,$email,$pwd){

        $validate = $this->existUser($email);
        if(count($validate) > 0 ){
          $res = ["Error", "Este usuario ya existe"];

        }else{
            $sql="INSERT INTO users(name,email,pwd) VALUES('$name','$email','$pwd')";
            mysqli_query($this->conn,$sql);
            $res =['succes', 'Usuario guardado'];
        }
        return $res;
}

//UPDATE
    public function updateUsers($id,$name,$email,$pwd){

        $validate = $this->existUser($email);
            $res= ['error', 'El usuario no existe'];
            if(count($validate)>0){
                    $sql = "UPDATE users SET name='$name', email='$email', pwd='$pwd' WHERE id='$id'";
                    mysqli_query($this->conn,$sql);
                    $res = ['succes', 'Usuario actualizado'];
        }
        return $res;
    }
    
//DELETE
    public function deleteUsers($id){
        $validate = $this->getUsers($id);
        $res = ["error", "No existe el producto"];

        if(count($validate) > 0){

            $sql="DELETE FROM users WHERE id='$id' ";
            mysqli_query($this->conn,$sql);
            $res = ["succes", "Usuario eliminado"];   
        }
    
        return $res;
    }

    //IF USER EXIST
    public function existUser($email){

        $users=[];
        $sql = "SELECT * FROM users WHERE email='$email' ";
        $res = mysqli_query($this->conn,$sql);

        while($row = mysqli_fetch_assoc($res)){
            array_push($users,$row);
        }
        return $users;
    }
}

?>