<?php
session_start();

$auth_role = [1];
// $password = "apple";
// $password = md5($shaKey . md5($password));
// echo $password;
// 1bc42deee499c3eacd84beb569ebb9e0
// 1bc42deee499c3eacd84beb569ebb9e0 

// config
// require_once('../config/require.php');

require_once('../config/config.php');
require_once('../config/auth.php');
require_once('../config/database.php');
require_once('../config/include_function.php');
require_once('../config/admin_middleware.php');

// echo $user_id;
$title = "MMCupid::CreateCity";
$name = "";
$error = false;
$errorMessage = "";
$processError = false;
// $url = $adminBaseUrl . "show_city.php";

if (isset($_POST['submit'])) {
    $name = $mysqli->real_escape_string($_POST['name']);

    if ($name == '') {
        $error = true;
        $errorMessage = "need to fill city";
        $processError = true;
    } else {
        $sql = "INSERT INTO `city`( `name`,`created_by`, `updated_by`) VALUES ('$name','$user_id','$user_id')";
        $query = $mysqli->query($sql);
        if ($query) {
            $url = $adminBaseUrl . "show_city.php";
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
                    <h2>Create City<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="<?php echo $adminBaseUrl ?>create_city.php" method="POST">

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" placeholder="fill name" class="form-control" name="name" value="<?php echo $name; ?>">
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