<?php
session_start();

require_once('../config/config.php');
require_once('../config/include_function.php');
require_once('../config/database.php');

// $password = "password";
// $password = md5($shaKey . md5($password));
// 1bc42deee499c3eacd84beb569ebb9e0
// 1bc42deee499c3eacd84beb569ebb9e0 

// echo $password for linhtutkyaw;
// 06e0c99c401aec0c3cecab384d6bfd1f db pass
// 06e0c99c401aec0c3cecab384d6bfd1f userPass
// exit();

// role 1 is admin
// status 0 is active 

$error = false;
$errorMessage = "";
$processError = false;

if (isset($_POST['submit'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    if ($username == '') {
        $error = true;
        $errorMessage .= "username need to fill!<br>";
        $processError = true;
    }

    if ($password == '') {
        $error = true;
        $errorMessage .= "password need to fill!<br>";
        $processError = true;
    }

    if ($password == '' && $name == '') {
        $error = true;
        $errorMessage .= "credential error!<br>";
        $processError = true;
    }

    if ($processError == false) {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT `id`, `username`, `password`, `role`, `status` FROM `user` WHERE username='$username'";
        
        $query = $mysqli->query($sql);
        // query_row is just a row does not include data 
        $query_row = $query->num_rows;
        if ($query_row <= 0) {
            $error = true;
            $errorMessage .= "username does not exist in database!<br>";
        } else {
            $password = generatePass($password, $shaKey);
            $user_db = $query->fetch_assoc();
            //  echo $user_db['password'] . $password;
            //  die;
            // print_r($user_db);
            // exit();
            if ($password = $user_db['password']) {
                // 0 is active when data store bec he is not ban
                if ($user_db['status'] == 0) {
                    if (isset($_POST['remember']) || ($_POST['remember']) == 1) {
                        $cookieName = "id";
                        $cookieValue = $user_db['id'];
                        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
                        $cookieName = "username";
                        $cookieValue = $user_db['username'];
                        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
                        $cookieName = "role";
                        $cookieValue = $user_db['role'];
                        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
                        $cookieName = "status";
                        $cookieValue = $user_db['status'];
                        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
                        // $cookieName = "password";
                        // $cookieValue = $user_db['password'];
                        // setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/");
                    } else {
                        $_SESSION['id'] = $user_db['id'];
                        $_SESSION['username'] = $user_db['username'];
                        $_SESSION['role'] = $user_db['role'];
                        $_SESSION['status'] = $user_db['status'];
                    }
                    $url = $adminBaseUrl . "index.php";
                    header("Refresh:0;url=$url");
                    exit();
                } else {
                    $error = true;
                    $errorMessage .= "U have been ban from Our Sever!<br>";
                }
            } else {
                $error = true;
                $errorMessage .= "password wrong!<br>";
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $baseUrl ?>assets/images/dating.png">
    <title><?php echo $siteTitle ?></title>


    <!-- Bootstrap -->
    <link href="<?php echo $baseUrl; ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo $baseUrl; ?>assets/css/font-awesome/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo $baseUrl ?>assets/css/pnotify/pnotify.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo $baseUrl; ?>assets/css/custom.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="<?php echo $adminBaseUrl ?>login.php" method="post">
                        <h1>Login Form Admin</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="username" name="username" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                        </div>

                        <div class="form-check text-left">
                            <input class="form-check-input" type="checkbox" value="1" name="remember" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me </label>
                        </div>

                        <input type="hidden" class="form-control" name="form-sub" value="1" />

                        <button href="" class="btn btn-primary" type="submit" name="submit"> Create Account </button>
                        <br>
                        <div>
                            <p>@2024 All Rights Reserved.Dating App! is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
            </div>
            </form>
            </section>
        </div>
    </div>
    </div>


</body>
<script src="<?php echo $baseUrl ?>assets/js/jquery/jquery.min.js"></script>
<script src="<?php echo $baseUrl ?>assets/js/pnotify/pnotify.js"></script>

<?php
if ($error == true) {
?><script>
        new PNotify({
            title: 'New Thing',
            text: '<?php echo $errorMessage ?>',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
<?php
}
?>

</html>