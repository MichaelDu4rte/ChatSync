<?php
session_start();
include_once "config.php";

function redirect($url) {
    header("Location: $url");
    exit();
}

function generateRandomId() {
    return rand(1000000, 9999999); // 
}

function isValidImage($file) {
    $allowedExtensions = ['png', 'jpeg', 'jpg'];
    $imgExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    return in_array($imgExtension, $allowedExtensions) && getimagesize($file['tmp_name']);
}

function storeUploadedFile($file, $destination) {
    return move_uploaded_file($file['tmp_name'], $destination);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = pg_escape_string($connect, $_POST['fname']);
    $lname = pg_escape_string($connect, $_POST['lname']);
    $email = pg_escape_string($connect, $_POST['email']);
    $password = pg_escape_string($connect, $_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        if (validateEmail($email)) {
            $emailCheckQuery = pg_prepare($connect, "email_check_query", "SELECT email FROM users WHERE email = $1");
            $result = pg_execute($connect, "email_check_query", array($email));
            if (pg_num_rows($result) > 0) {
                echo "$email - o e-mail já está sendo usado.";
            } else {
                if (isset($_FILES['image']) && isValidImage($_FILES['image'])) {
                    $imgName = $_FILES['image']['name'];
                    $imgTmpName = $_FILES['image']['tmp_name'];
                    $newImgName = time() . "_" . $imgName;
                    $destination = "images/" . $newImgName;

                    if (storeUploadedFile($_FILES['image'], $destination)) {
                        $randomId = generateRandomId();
                        $hashedPassword = hashPassword($password);

                        $insertUserQuery = pg_prepare($connect, "insert_user_query", "INSERT INTO users (unique_id, fname, lname, email, pass, img) 
                                        VALUES ($1, $2, $3, $4, $5, $6)");
                        pg_execute($connect, "insert_user_query", array($randomId, $fname, $lname, $email, $hashedPassword, $newImgName));

                        $getUserQuery = pg_prepare($connect, "get_user_query", "SELECT * FROM users WHERE email = $1");
                        $result = pg_execute($connect, "get_user_query", array($email));

                        if (pg_num_rows($result) > 0) {
                            $row = pg_fetch_assoc($result);
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo "success";
                        }
                    } else {
                        echo "Erro ao mover o arquivo de imagem para o diretório de destino.";
                    }
                } else {
                    echo "Envie um arquivo de imagem válido (png, jpeg, jpg).";
                }
            }
        } else {
            echo "$email - endereço de e-mail inválido.";
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    redirect("register.php"); // Redireciona para a página inicial se a requisição não for POST
}
?>