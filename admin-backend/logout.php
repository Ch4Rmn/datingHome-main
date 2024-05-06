<?php
session_start();
require_once('../config/database.php');
require_once('../config/config.php');

session_unset();
session_destroy();

setcookie('id', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');
setcookie('role', '', time() - 3600, '/');
setcookie('status', '', time() - 3600, '/');

$url = $adminBaseUrl . "login.php";
header("Refresh:0;url=$url");
exit();
