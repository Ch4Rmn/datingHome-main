<?php
session_start();

$auth_role = [1];
// $password = "apple";
// $password = md5($shaKey . md5($password));
// echo $password;
// 1bc42deee499c3eacd84beb569ebb9e0
// 1bc42deee499c3eacd84beb569ebb9e0 

// config
require_once('../config/require.php');


// require_once('../config/config.php');
// require_once('../config/auth.php');
// require_once('../config/database.php');
// require_once('../config/include_function.php');
// require_once('../config/admin_middleware.php');

// echo $user_id;
$title = "MMCupid::Home";
$username = $password = $confirm_password = $role = '';
$error = false;
$errorMessage  = '';
$processError = false;
// $url = $adminBaseUrl . "show_user.php";


if (isset($_POST['form-sub']) && ($_POST['form-sub']) == 1) {
    // echo true;
    // exit();
    // $url = $adminBaseUrl . "login.php";
    // header("Refresh:0;url=$url");
    // exit();
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);
    $role = (int)($_POST['role']);
    $status = (int)($_POST['status']);

    if ($username == '') {
        $error = true;
        $errorMessage .= "Fill username plz.</br>";
        $processError = true;
    }
    if ($password == '') {
        $error = true;
        $errorMessage .= "Fill password plz.</br>";
        $processError = true;
    }
    if ($confirm_password == '') {
        $error = true;
        $errorMessage .= "Fill confirm_password plz.</br>";
        $processError = true;
    }
    if ($confirm_password != $password) {
        $error = true;
        $errorMessage .= "Password and Confirm_Password Did'nt Match plz.</br>";
        $processError = true;
    }
    if ($role == '') {
        $error = true;
        $errorMessage .= "Select role plz.</br>";
        $processError = true;
    }

    $checkUsernameQuery = "SELECT COUNT(*) AS count FROM `user` WHERE `username` = '$username'";
    $checkUsernameSql = $mysqli->query($checkUsernameQuery);
    $checkUsernameData = $checkUsernameSql->fetch_assoc();

    if ($checkUsernameData['count'] > 0) {
        $error = true;
        $errorMessage .= "Username already exists. Please choose a different username.</br>";
        $processError = true;
    }

    if ($processError == false) {
        $password = generatePass($password, $shaKey);
        $createSql = "INSERT INTO `user`(`username`, `password`, `role`,`updated_by`, `created_by`) VALUES ('$username','$password','$role','$user_id','$user_id')";
        $createQuery = $mysqli->query($createSql);
        if ($createQuery === true) {
            $url = $adminBaseUrl . "login.php";
            header("Refresh:0;url=$url");
            exit();
        } else {
            // Handle error if the query fails
            $error = true;
            $errorMessage .= "Error When Create: " . $mysqli->error . "</br>";
        }
    }
}
// header 
require_once('../master/cp-template-header.php');
// sidebar 
require_once('../master/cp-template-sidebar.php');
// <!-- top navigation -->
require_once('../master/cp-template-navbar.php');



?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row shadow-sm">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create User<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="<?php echo $adminBaseUrl ?>create_user.php" method="POST">
                        <!-- <form id=" demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $adminBaseUrl ?>create_user.php" method="post"> -->
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="username" placeholder="fill username" class="form-control" name="username" value="<?php echo $username; ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="password" placeholder="fill password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class=" item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="confirm_password">Confirm Password</label> <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="confirm_password" placeholder="fill confirm-password" name="confirm_password" class="form-control">
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="Role">Role</label> <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" id="role" name="role">
                                    <option value="">Choose Role</option>
                                    <option value="1" <?php if ($role == 1) {
                                                            echo "selected";
                                                        } ?>>Admin</option>
                                    <option value="2" <?php if ($role == 2) {
                                                            echo "selected";
                                                        } ?>>Customer Service</option>
                                    <option value="3" <?php if ($role == 3) {
                                                            echo "selected";
                                                        } ?>>Editor</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="form-sub" value="1">
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" name="submit" value="submit"></input>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// footer 
require_once('../master/cp-template-footer.php');
// end 
if ($error == true) {
?>
    <script>
        new PNotify({
            title: 'Error',
            text: '<?php echo $errorMessage ?>',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
<?php
}
require_once('../master/cp-template-end.php');
?>