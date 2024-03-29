<?php
session_start();
include_once "config.php";

// Pegando os valores dos campos do formulário
$email = pg_escape_string($connect, $_POST['email']);
$password = pg_escape_string($connect, $_POST['password']);

if (!empty($email) && !empty($password)) {

    // checa se tem no db usando parâmetros preparados
    $sql = pg_prepare($connect, "login_query", 'SELECT * FROM users WHERE email = $1 AND pass = $2');
    $result = pg_execute($connect, "login_query", array($email, $password));

    // posso logar
    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $_SESSION['unique_id'] = $row['unique_id'];
        echo "success";
    } else { // se nao
        echo "Email ou senha estão inválidos.";
    } 

} else {
    echo "Por favor, preencha os campos para continuar";
}
?>