<?php
session_start();
$_SESSION['name'] = '';
$_SESSION['error'] = '';
unset($_SESSION['name']);
session_destroy();
header('Location: login.php');
