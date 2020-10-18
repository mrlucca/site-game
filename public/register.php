<?php
require_once __DIR__ . "/../src/models/DataBase.php";
require_once __DIR__ . "/../src/models/Register.php";
$connect = DataBase::getConnection();

$response = null;
if(!empty($_POST['register_name'])
and !empty($_POST['register_email'])
and !empty($_POST['register_lastname'])
and !empty($_POST['register_password'])
and !empty( $_POST['c_password'])){
    $conn = new Register(
        $_POST['register_name'],
        $_POST['register_lastname'],
        $_POST['register_email'],
        $_POST['register_password'],
        $_POST['c_password'],
        $connect
    );

    $response = $conn->registered();

    if($response['registered']){
        $response['err'] = "";
    }

    $tagValid = $response['registered'] ? "is-valid" :  "is-invalid";
}

?>
<!doctype html>
<html lang="pt-BR">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/register.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-sm bg-dark justify-content-center">
        <a type="button" class="btn btn-outline-warning"
           href="login.php">Login</a>

        </div>
    </nav>
</header>
<div class="container">

    <main>
        <?php if($response !== null) :?>
            <?php if($response['registered'] == false): ?>
                <?php foreach ($response['err'] as $value): ?>
                <div class="d-flex justify-content-center alert alert-danger" role="alert"
                        <p><?= $value ?></p>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if($response['registered'] == true): ?>
                <div class="d-flex justify-content-center alert alert-success" role="alert">
                    <p>User has been registered</p>
                </div>

            <?php endif; ?>
    <?php endif; ?>

        <form action="#" method="post">
            <div class="d-flex justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="register_name">Name</label>
                    <input type="text" class="form-control <?= $tagValid ?>"
                           id="register_name" name="register_name" placeholder="Nome" required>
                    <div class="valid-feedback">
                        All right!
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-6 mb-3">
                        <label for="register_lastname">Last Name</label>
                        <input type="text" class="form-control <?= $tagValid ?>"
                               id="register_lastname" name="register_lastname" placeholder="Last Name" required>
                        <div class="valid-feedback">
                            All right!
                        </div>
                    </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-6 mb-3">
                    <label for="register_email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input type="text" class="form-control <?= $tagValid ?> id="register_email" name="register_email"
                               placeholder="example@gmail.com" aria-describedby="inputGroupPrepend3" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-md-3 mb-3">
                    <label for="register_password">Password</label>
                    <input type="password" class="form-control <?= $tagValid ?>"
                           id="register_password" name="register_password" placeholder="password" required>

                </div>

                <div class="col-md-3 mb-3">
                    <label for="c_password">Confirm password</label>
                    <input type="password" class="form-control <? $tagValid ?>"
                                  id="c_password" name="c_password" placeholder="confirm password" required>

                </div>

            </div>

            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </main>
</div>
<script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>

