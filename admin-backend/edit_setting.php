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

$user_sql = "SELECT * FROM setting WHERE id='$id' AND deleted_at IS NULL";
$user_query = $mysqli->query($user_sql);
$user_num_row = $user_query->num_rows;

if ($user_num_row > 0) {
    while ($user_row = $user_query->fetch_assoc()) {
        $point = htmlspecialchars($user_row['point']);
        $company_name = htmlspecialchars($user_row['company_name']);
        $company_email = htmlspecialchars($user_row['company_email']);
        $company_logo = htmlspecialchars($user_row['company_logo']);
        $company_phone = htmlspecialchars($user_row['company_phone']);
        // $company_phone = htmlspecialchars($user_row['company_phone']);
        // $id = htmlspecialchars($user_row['id']);
        // $status = htmlspecialchars($user_row['status']);
        // $role = htmlspecialchars($user_row['role']);
    }
} else {
    $error = true;
    $errorMessage = 'Hobbies not found or Deleted from Our Main Server!';
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
                        <form action="<?php echo $adminBaseUrl ?>update_setting.php?id=<?php echo $id; ?>" method="POST">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="point">point <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="point" placeholder="fill point" class="form-control" name="point" value="<?php echo $point; ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_name">company_name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="company_name" placeholder="fill company_name" class="form-control" name="company_name" value="<?php echo $company_name; ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_email">company_email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="company_email" placeholder="fill company_email" class="form-control" name="company_email" value="<?php echo $company_email; ?>">
                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_logo">company_logo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="company_logo" placeholder="fill company_logo" class="form-control" name="company_logo" value="<?php echo $company_logo; ?>">
                                </div>
                            </div> -->

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_phone">company_phone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="company_phone" placeholder="fill company_phone" class="form-control" name="company_phone" value="<?php echo $company_phone; ?>">
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


<!-- <button type="button" class="btn btn-secondary" onclick="history.back()">Go Back</button> -->
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