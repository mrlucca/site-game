<?php
session_start();
if(empty($_SESSION['name'])){
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../src/controllers/Page.php';

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <title>Lucca Art</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <header>
        <div class="navbar">
            <div class="d-flex justify-content-start">
                <h2>Hello <?= $_SESSION['name'] ?></h2>
            </div>

            <div class="d-flex justify-content-end mr-3">
                <a class="btn btn-outline-warning d-flex justify-content-end mr-2"
                   href="index.php?page=home">HOME</a>
                <a class="btn btn-outline-warning d-flex justify-content-end mr-2"
                   href="index.php?page=wiki">WIKI</a>
                <a class="btn btn-outline-warning d-flex justify-content-end mr-2"
                   href="index.php?page=history">HISTORY</a>
                <div class="logout"><a class="btn btn-outline-warning d-flex justify-content-end mr-2"
                                       href="logout.php">Logout</a></div>
            </div>

        </div>
    </header>
    <main>
        <?php
            if(!empty($_GET['page'])) {

                Page::setPage($_GET['page']);
                $resultGetPage = Page::getContent();

                if($resultGetPage['page']) {

                    include($resultGetPage['path']);
                }else {

                    include($resultGetPage['path']);
                }
            }else{
                require_once __DIR__ . "/../src/views/home.php";
            }

        ?>
    </main>

    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
