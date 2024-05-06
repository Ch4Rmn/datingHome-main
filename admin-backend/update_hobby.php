<?php
session_start();
$auth_role = [1];

require_once('../config/require.php');
$name = '';
$processError = false;
$error = false;


if (isset($_POST['submit'])) {
    $id = (int) $_GET['id'];
    $name = $mysqli->real_escape_string($_POST['name']);


    if ($name == '') {
        $error = true;
        $errorMessage .= "Fill name plz.</br>";
        $processError = true;
    }

    $user_exist = "SELECT `name` FROM `hobbies` WHERE name='$name' AND id!='$id'";
    $user_exist_query = $mysqli->query($user_exist);

    if ($user_exist_query->num_rows >= 1) {
        echo "City with the same name already exists.";
    } else {
        if ($processError == false) {
            $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_COOKIE['id']) ? $_COOKIE['id'] : null);
            if ($user_id) {
                $update_sql = "UPDATE `hobbies` SET name='$name', updated_at=CURRENT_TIMESTAMP, updated_by='$user_id' WHERE id=$id";
                $update_query = $mysqli->query($update_sql);
                if ($update_query) {
                    $url = $adminBaseUrl . "show_hobby.php";
                    header("Refresh:0;url=$url");
                    exit();
                } else {
                    echo "Error updating record: " . $mysqli->error;
                }
            }
        } else {
            echo "Hobby ID not found.";
        }
    }
}
