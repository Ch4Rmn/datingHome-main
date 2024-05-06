 <?php
    session_start();

    require_once('../config/database.php');
    require_once('../config/config.php');

    $auth = false;

    if (isset($_SESSION['id']) || $_SESSION['id']) {
        $auth = true;
        $user_id = $_SESSION['id'];
        // $username = $_SESSION['username'];
    }
    if (
        isset($_COOKIE['id']) || isset($_COOKIE['id'])
    ) {
        $auth = true;
        $user_id = $_COOKIE['id'];
        // $username = $_SESSION['username'];

    }

    if ($auth == false) {
        $url = $adminBaseUrl . "login.php";
        header("Refresh:0;url=$url");
        exit();
    } else {
        $sql = "SELECT `status` FROM `user` WHERE id=$user_id AND deleted_by IS NULL";
        // $sql = "SELECT `status` FROM `user` WHERE id=$user_id AND status=0";
        $query = $mysqli->query($sql);
        // status ka 0 and have data 

        $num_row = $query->num_rows;
        // 1 row with status 0 with active

        if ($num_row <= 0) {
            // 1 row with status 1 with ban
            $url = $adminBaseUrl . "logout.php";
            header("Refresh:0;url=$url");
            exit();
        } else {
            $row = $query->fetch_assoc();
            // if status is 1 ban 
            if ($row['status'] == 1) {
                $url = $adminBaseUrl . "logout.php";
                header("Refresh:0;url=$url");
                exit();
            }
        }
    }
