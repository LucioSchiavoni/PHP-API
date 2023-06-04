<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Allow: *");

header("content-type: application/json; charset=utf-8");
class userModel{
    public $conn;
    public function __construct(){
        $this->conn = new mysqli('localhost', 'root', '', 'server-test-1');
        mysqli_set_charset($this->conn,'utf8');
    }

//GET *
    public function getUsers($id=null){
    $where = ($id == null) ? "" : " WHERE id='$id' ";
    $usuarios = [];
    $sql= "SELECT * FROM usuarios ".$where;
    $res = mysqli_query($this->conn, $sql);
    while($row = mysqli_fetch_assoc($res)){
        array_push($usuarios,$row);
    }
    return $usuarios;
}

//GET ID
    public function getUsersById($id){
    
    $sql= "SELECT FROM usuarios WHERE id='$id' ";
    $res = mysqli_query($this->conn, $sql);
    return $res;

    return $usuarios;
}

//POST
    public function saveUsers($ci,$nombre,$apellido,$fnac,$email,$clave,$sexo){

        $validate = $this->existUser($email);
        if(count($validate) > 0 ){
          $res = ["Error", "Este usuario ya existe"];

        }else{
            $sql="INSERT INTO usuarios(ci,nombre,apellido,fnac, email, clave,sexo) VALUES('$ci','$nombre','$apellido','$fnac', '$email','$clave','$sexo')";
            mysqli_query($this->conn,$sql);
            $res =['succes', 'Usuario guardado'];
        }
        return $res;
}

//UPDATE
    public function updateUsers($id,$name,$email,$pwd){

        // $validate = $this->existUser($id);
        //     $res= ['error', 'El usuario no existe'];
            // if(count($validate)>0){
                    $sql = "UPDATE usuarios SET name='$name', email='$email', pwd='$pwd' WHERE id='$id'";
                    mysqli_query($this->conn,$sql);
                    $res = ['succes', 'Usuario actualizado'];
        // }
        return $res;
    }
    
//DELETE
    public function deleteUsers($id){
        $validate = $this->getUsers($id);
        $res = ["error", "No existe el producto"];

        if(count($validate) > 0){

            $sql="DELETE FROM usuarios WHERE id='$id' ";
            mysqli_query($this->conn,$sql);
            $res = ["succes", "Usuario eliminado"];   
        }
    
        return $res;
    }

    //IF USER EXIST
    public function existUser($email){

        $users=[];
        $sql = "SELECT * FROM usuarios WHERE email='$email' ";
        $res = mysqli_query($this->conn,$sql);

        while($row = mysqli_fetch_assoc($res)){
            array_push($users,$row);
        }
        return $users;
    }
}

?>