<?php
session_start();
$auth_role = [1];

// if (isset($_SESSION['id'])) {
//     $user_id =  $_SESSION['id'];
// } else {
//     echo $_COOKIE['id'];
// }


// config 
require_once('../config/config.php');
require_once('../config/database.php');
require_once('../config/include_function.php');
require_once('../config/auth.php');
require_once('../config/admin_middleware.php');

$title = "MMCupid::Show Users";
$edit_link = "edit_user.php";
$delete_link = "delete_user.php";
$change_password_link = "change_password_user.php";
// header 
require_once('../master/cp-template-header.php');
// sidebar 
require_once('../master/cp-template-sidebar.php');
// <!-- top navigation -->
require_once('../master/cp-template-navbar.php');

$sql = "SELECT 
    `id`, 
    `username`, 
    CASE 
        WHEN `role` = 1 THEN 'admin'
        WHEN `role` = 2 THEN 'customer_service'
        WHEN `role` = 3 THEN 'editor'
        ELSE 'unknown'
    END AS `role_name`, 
    `status`, 
    `created_at`, 
    `updated_at` 
FROM 
    `user` 
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
                    <table class="table table-striped jambo_table bulk_action ">
                        <thead class="">
                            <tr class="headings my-2">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">id </th>
                                <th class="column-title">Username </th>
                                <th class="column-title">Role </th>
                                <th class="column-title">Status</th>
                                <th class="column-title">Created_by</th>
                                <th class="column-title">Action</th>
                                </th>
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
                                    $userID = $user['id'];
                                    $username = $user['username'];
                                    $role_name = $user['role_name'];
                                    $status = $user['status'];
                            ?>
                                    <tr class="even pointer">
                                        <td class="a-center">
                                            <input type="checkbox" class="flat" name="table_records">
                                        </td>
                                        <td class=""><?php echo $userID ?></td>

                                        <td class="">
                                            <h4 class=""><?php echo $username ?></h4>
                                        </td>
                                        <td class=""><?php echo $role_name ?></td>
                                        <td class="">
                                            <?php
                                            if ($status == 0) {
                                                echo "<p class='bg-success rounded p-1 shadow text-white'>Active</p>";
                                            } else {
                                                echo "<p class='bg-danger rounded p-1 shadow'>Inactive</p>";
                                            }
                                            ?>
                                        </td>
                                        <td class=""><?php echo $user['created_at'] ?></td>
                                        <td>

                                            <a class="btn btn-danger" href='javascript:void(0)' onclick="confirmDelete('<?php echo $adminBaseUrl . $delete_link . '?id=' . $userID; ?>')"> <i class="fa fa-trash-o"></i>Delete</a>

                                            <a class="btn btn-success" href='javascript:void(0)' onclick="confirmChangePass('<?php echo $adminBaseUrl . $change_password_link . '?id=' . $userID; ?>')"> <i class="fa fa-gear"></i>ChangePass</a>

                                            <a class="btn btn-primary" href='javascript:void(0)' onclick="confirmEdit('<?php echo $adminBaseUrl . $edit_link . '?id=' . $userID; ?>')"> <i class="fa fa-pencil"></i>Edit</a>

                                        </td>
                                    </tr>
                            <?php
                                } 
                            } 
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
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                setTimeout(() => {
                    Swal.fire({
                        title: "Delete Complete",
                        text: "Your file has been deleted.",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(() => {
                        // Redirect to the specified URL
                        window.location.href = url;
                    });
                }, 1000); // Simulated delay of 1 second (1000 milliseconds)
            }
        });
    }


    function confirmChangePass(url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Change Password it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmEdit(url) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
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