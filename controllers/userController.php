<?php  
header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("content-type: application/json; charset=utf-8");
include("../model/userModel.php");
$userModel = new userModel();


    switch($_SERVER['REQUEST_METHOD']){

        case 'POST':
            if(!empty($_GET['formato'])){

                $res = $userModel->getUsers();
                echo json_encode($res);

            }else if(!empty($_GET['formatoPut'])) {  
                $res = $userModel->updateUsers($_POST['id'],$_POST['ci'],$_POST['nombre'],$_POST['apellido'],$_POST['fnac'],$_POST['email'],$_POST['clave'],$_POST['sexo']);
                echo json_encode($res);


            }else if(!empty($_GET['formatoDelete'])){
                $res = $userModel->deleteUsers($_POST['id']);
                echo json_encode($res);
            }else if (!empty($_GET['formatoPost'])){
                 if(strlen($_POST['clave']) < 8){
                    $res = ['Error', 'Su contrasena debe contener mas de 8 caracteres'];
                }else if(preg_match('/\d/',$_POST['nombre'])){
                    $res = ['Error', 'Ingrese un nombre valido'];

                }else{
                    $res = $userModel->saveUsers($_POST['ci'],$_POST['nombre'],$_POST['apellido'],$_POST['fnac'],$_POST['email'],$_POST['clave'],$_POST['sexo']);
                }
                echo json_encode($res);
                
            }else{
            $res = ['Error', 'Error en el servidor'];
          
            }

            break;

        case 'GET':

            $res = $userModel->getUsers();
            echo json_encode($res);
            break;

        case 'PUT': 

            $_PUT= json_decode(file_get_contents('php://input', true));
            $res = $userModel->updateUsers($_PUT->id,$_PUT->name,$_PUT->email,$_PUT->pwd);
            echo json_encode($res);


            break;

        case 'DELETE':
             $_DELETE= json_decode(file_get_contents('php://input', true));

                   $res = $userModel->deleteUsers($_DELETE->id);
            echo json_encode($res);


            break;
}



?>