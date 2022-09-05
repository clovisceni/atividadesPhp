<?php

require_once 'config.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($name && $email){

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if($sql->rowCount() === 0){

    $sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)"); //template
    $sql->bindValue(':name', $name); // o valor que mandar para ca agora sera mudado.
    $sql->bindParam(':email', $email); //estou associando a variavel e-mail com o parametro.
    $sql->execute();

    header("Location: index.php");
    exit;

}else{
    header("Location: adicionar.php");
}

}else{
    header("Location: adicionar.php");
    exit;
}

?>