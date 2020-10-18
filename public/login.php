<?php
session_start();
require_once __DIR__ . "/../src/models/DataBase.php";
require_once __DIR__ . "/../src/models/CheckConnect.php";

$connect = DataBase::getConnection();


if(!empty($_POST['email']) and !empty($_POST['password'])) {
    $check = new CheckConnect($_POST['email'], $_POST['password'], $connect);
    $result = $check->getName();
    if ($result["login"]) {
        $_SESSION['name'] = $result['name'];
        header('Location: index.php');
    }

    if(!empty($result['err'])){
        $_SESSION['error'] = $result['err'];
    }

}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid row">
    <div class="nave col-9">
        <img class="vibrate-2" src="./assets/img/nav.png" >
    </div>

    <div class="login col-3 border border rounded-lg mt-5 ">
        <div class="form-group align-items-center mt-5 ">
            <form action="login.php" method="post" id="form-login">
                <div class="login-input form-group">
                    <label for="email">Email address</label>
                    <input placeholder="example@gmail.com" type="email"
                           class="form-control" name="email" id="email">
                </div>

                <div class="login-input form-group">
                    <label for="password">password</label>
                    <input placeholder="password" type="password"
                           class="form-control" name="password" id="password">
                </div>

                <a class="btn btn-outline-warning form-group"
                        href="#"  onclick="document.getElementById('form-login').submit()">Login</a>
                <a class="btn btn-outline-secondary form-group"
                        href="register.php">Register</a>

                <div class="error form-group">
                    <?php if(!empty($_SESSION['error'])): ?>
                        <?php foreach ($_SESSION['error'] as $errors): ?>
                            <p class="alert alert-danger"><?= $errors ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </form>
        </div>

    </div>
</div>
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>