<?php

$user_role = (isset($_SESSION['role'])) ? ($_SESSION['role']) : ($_COOKIE['role']);
if (!in_array($user_role, $auth_role)) {
    $url = $adminBaseUrl . "403_forbidden.php";
    header("Refresh:0;url=$url");
    exit();
}

// else {
//     $url = $adminBaseUrl . "login.php";
//     header("Refresh:0;url=$url");
//     exit();
// }
