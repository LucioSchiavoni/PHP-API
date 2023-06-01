<?php

// Conexion a la BD
$db = new PDO('mysql:host=localhost;dbname=serer-test-1', 'root', '');

//Toma el usuario y password de la peticion
$username = $_POST['name'];
$password = $_POST['pwd'];

// Se corrobora si el usuario y password son validos
$sql = 'SELECT * FROM users WHERE name = :name AND pwd = :pwd';
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $username);
$stmt->bindParam(':pwd', $password);
$stmt->execute();

//Si el usuario es encontrado, se logea
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

   //Se crea una sesion para el usuario
    session_start();
    $_SESSION['user_id'] = $user['id'];

  //Redireccion 
    header('Location: /');
} else {
   //Usuario no encontrado
    echo 'usuario o contraseña Incorrectos';
}

?>