<?php 

include("../config/db.php");

// corroboro si ya no existe ese email
$sql = 'SELECT * FROM users WHERE email = :email';
$stmt = $db->prepare($sql);
$stmt->bindParam(':email', $_POST['email']);
$stmt->execute();

//Si el email es encontrado, ya esta registrado, vuelva al login.
if ($stmt->rowCount() > 0) {
    header('Location: login.php');
    exit;
}

// Insertar nuevo usuario
$sql = 'INSERT INTO users (name, email, pwd) VALUES (:name, :email, :pwd)';
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':pwd', $_POST['pwd']);
$stmt->execute();

// Redireccion 
header('Location: home.php');
exit;

?>



