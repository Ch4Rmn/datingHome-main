<?php
session_start();
$auth_role = [1];
$userID = isset($_SESSION['id']) ? ($_SESSION['id']) : ($_COOKIE['id']);
// die;

// config 
require_once('../config/config.php');
require_once('../config/database.php');
require_once('../config/include_function.php');
require_once('../config/auth.php');
require_once('../config/admin_middleware.php');

$title = "MMCupid::Show Users";
// header 
require_once('../master/cp-template-header.php');
// sidebar 
require_once('../master/cp-template-sidebar.php');
// top navigation
require_once('../master/cp-template-navbar.php');

$edit_link = "edit_setting.php";
$delete_link = "delete_setting.php";

$sql = "SELECT 
    *
FROM 
    `setting` 
WHERE 
    `deleted_at` IS NULL 
ORDER BY 
    `created_at` DESC;
";
$query = $mysqli->query($sql);

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_content">
                <div class="table-responsive">
                    <h1>Show Setting</h1>
                    <table class="table table-striped jambo_table bulk_action ">
                        <thead class="">
                            <tr class="headings my-2">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">id </th>

                                <th class="column-title">point </th>
                                <th class="column-title">company_name </th>
                                <th class="column-title">company_logo </th>
                                <th class="column-title">company_phone </th>
                                <th class="column-title">company_email </th>
                                <th class="column-title">Action </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $num_row = $query->num_rows;
                            if ($num_row >= 1) {
                                while ($user = $query->fetch_assoc()) {
                                    // print_r($user);
                                    // die;
                                    $id = $user['id'];

                                    $point = $user['point'];
                                    $company_name = $user['company_name'];
                                    // $company_logo = $user['company_logo'];
                                    $company_phone = $user['company_phone'];
                                    $company_email = $user['company_email'];


                            ?>
                                    <tr class="even pointer">
                                        <td class="a-center">
                                            <input type="checkbox" class="flat" name="table_records">
                                        </td>
                                        <td class=""><?php echo $id ?></td>

                                        <td class=""><?php echo $point ?></td>
                                        <td class="">
                                            <h4 class=""><?php echo $company_name ?></h4>
                                        </td>
                                        <!-- http://localhost/datingHome/imagesUpload/editor.jpeg -->

                                        <td>
                                            <?php if (!empty($user['company_logo'])) : ?>
                                                <img src="<?php echo $adminBaseUrl . htmlspecialchars($user['company_logo']); ?>" id="preview-selected-image" style="width: 100px;height:100px;object-fit: cover;" />
                                            <?php else : ?>
                                                <!-- Default image -->
                                                <img src="../assets/images/editor.jpeg" style="width: 100px;height:100px;object-fit: cover;" id="preview-selected-image" style="width: 100px;height:100px;object-fit: cover;" />
                                            <?php endif; ?>
                                        </td>

                                        <td class=""><?php echo $company_phone ?></td>
                                        <td class=""><?php echo $company_email ?></td>


                                        <td>
                                            <!-- Replace placeholders with appropriate URLs -->
                                            <a class="btn btn-danger" href='javascript:void(0)' onclick="confirmDelete('<?php echo $adminBaseUrl . $delete_link . '?id=' . $userID; ?>')"> <i class="fa fa-trash-o"></i>Delete</a>
                                            <a class="btn btn-primary" href='javascript:void(0)' onclick="confirmEdit('<?php echo $adminBaseUrl . $edit_link . '?id=' . $id; ?>')"> <i class="fa fa-pencil"></i>Edit</a>
                                        </td>
                                    </tr>
                            <?php
                                } // End of the while loop
                            } // End of the if condition
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// footer 
require_once('../master/cp-template-footer.php'); ?>
<script>
    function confirmDelete(url) {
        Swal.fire({
            icon: "error",
            title: "Oops...We didn't allow to DELETE",
            text: "Something went wrong!",
            footer: '<a href="#">Why do I have this issue?</a>'
        });
    }
    
    function confirmEdit(url) {
        Swal.fire({
            title: "Are you sure to EDIT?",
            text: "U cant update image bec of our policy",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes,Edit it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
<?php
require_once('../master/cp-template-end.php');
?>