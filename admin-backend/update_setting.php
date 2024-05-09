<?php
session_start();
$auth_role = [1];

require_once('../config/require.php');
$point = $company_logo =  $company_name = $company_phone = $company_email = "";
$processError = false;
$error = false;


if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $point = (int)$_POST['point'];
    $company_phone = (int)($_POST['company_phone']);
    $company_email = $mysqli->real_escape_string($_POST['company_email']);
    $company_name = $mysqli->real_escape_string($_POST['company_name']);
    // $company_logo = $mysqli->real_escape_string($_POST['company_logo']);


    $user_exist = "SELECT `company_name` FROM `setting` WHERE company_name='$company_name' AND id!='$id'";
    $user_exist_query = $mysqli->query($user_exist);

    if ($user_exist_query->num_rows >= 1) {
        echo "company_name with the same company_name already exists.";
    } else {
        if ($processError == false) {
            if (isset($_FILES['company_logo'])) {
                $uploadDir = "imagesUpload/";

                // Create the upload directory if it doesn't exist
                if (!is_dir($uploadDir) || !file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate a unique filename for the new image
                $image_name = $uploadDir . uniqid() . date("d-m-y") . $_FILES['company_logo']['name'];
                $tmp_name = $_FILES['company_logo']['tmp_name'];

                // Check if the file already exists
                if (file_exists($image_name)) {
                    // If the file exists, delete it
                    unlink($image_name);
                }

                // Move the uploaded file to the destination
                move_uploaded_file($tmp_name, $image_name);
            }



            $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : (isset($_COOKIE['id']) ? $_COOKIE['id'] : null);
            if ($user_id) {
                $update_sql = "UPDATE `setting` SET point='$point', company_name='$company_name',company_logo='$image_name', company_email='$company_email',company_phone='$company_phone', updated_at=CURRENT_TIMESTAMP, updated_by='$user_id' WHERE id=$id";
                $update_query = $mysqli->query($update_sql);
                if ($update_query) {
                    $url = $adminBaseUrl . "show_setting.php";
                    header("Refresh:0;url=$url");
                    exit();
                } else {
                    echo "Error updating record: " . $mysqli->error;
                }
            }
        } else {
            echo "User ID not found.";
        }
    }
}
