<?php
session_start();
$auth_role = [1];

// echo $user_id;
// exit();
require_once('../config/require.php');

// require_once('../config/config.php');
// require_once('../config/database.php');
// require_once('../config/include_function.php');
// require_once('../config/auth.php');
// require_once('../config/admin_middleware.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteUserSql = "UPDATE `city` SET deleted_at = CURRENT_TIMESTAMP, deleted_by = '$user_id' WHERE id = '$id'";
    $deleteUserQuery = $mysqli->query($deleteUserSql);

    if ($deleteUserQuery) {
        $url = $adminBaseUrl . 'show_city.php/';
        header("Refresh:0;url=$url");
        exit();
    } else {
        $url = $adminBaseUrl . 'show_city.php/';
        header("Refresh:0;url=$url");
        exit();
    }
}
