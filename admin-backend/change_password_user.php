<?php
session_start();
$auth_role = [1];

// config 
require_once('../config/require.php');

$title = "MMCupid::Edit";
// header 
require_once('../master/cp-template-header.php');
// sidebar 
require_once('../master/cp-template-sidebar.php');
// <!-- top navigation -->
require_once('../master/cp-template-navbar.php');

$error = false;
$errorMessage  = '';
$processError = false;
$showForm = true;

$id = (int) $_GET['id'];

$user_sql = "SELECT * FROM user WHERE id='$id' AND deleted_at IS NULL";
$user_query = $mysqli->query($user_sql);
$user_num_row = $user_query->num_rows;

if ($user_num_row > 0) {
    while ($user_row = $user_query->fetch_assoc()) {
        $password = htmlspecialchars($user_row['$password']);
    }
} else {
    $error = true;
    $errorMessage = 'User not found or Deleted from Our Main Server!';
    $showForm = false;
}
?>

<?php if ($showForm) : ?>
    <div class="right_col" role="main">
        <div class="row shadow-sm">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit User<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo $adminBaseUrl ?>update_user_pass.php?id=<?php echo $id; ?>" method="POST">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="password" id="password" placeholder="fill password" class="form-control" name="password" value="<?php echo $password; ?>">
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="submit" class="btn btn-primary" name="submit" value="submit" <?php if (!$showForm) echo 'disabled'; ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- page content -->

<?php
// footer 
require_once('../master/cp-template-footer.php');
// end 
if ($error == true) :
?>
    <script>
        new PNotify({
            title: 'Error',
            text: '<?php echo $errorMessage ?>',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
<?php endif; ?>

<?php require_once('../master/cp-template-end.php'); ?>