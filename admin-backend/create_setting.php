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
$point = $company_logo =  $company_name = $company_phone = $company_email = "";
$uploadDir = "imagesUpload/";
$image = ($_FILES['company_logo']);


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
$num_row = $query->num_rows;
if ($num_row >= 1) {
    while ($user = $query->fetch_assoc()) {
        // print_r($user);
        // die;
        $id = $user['id'];
        $point = $user['point'];
        $company_name = $user['company_name'];
        $company_logo = $user['company_logo'];
        $company_phone = $user['company_phone'];
        $company_email = $user['company_email'];
        // echo $id;
        // exit();
        // echo $id;
        // exit();
    }
}


// $url = $adminBaseUrl . "show_city.php";

if (isset($_POST['submit'])) {

    // id 	point 	company_logo 	company_name 	company_phone 	company_email 
    $point = (int)($_POST['point']);
    $company_logo = $mysqli->real_escape_string($_POST['company_logo']);
    $company_name = $mysqli->real_escape_string($_POST['company_name']);
    $company_phone = $mysqli->real_escape_string($_POST['company_phone']);
    $company_email = $mysqli->real_escape_string($_POST['company_email']);

    if ($point == '' || !is_numeric($point)) {
        $error = true;
        $errorMessage .= "need to fill point<br>";
        $processError = true;
    }

    if ($company_name == '') {
        $error = true;
        $errorMessage .= "need to fill company_name<br>";
        $processError = true;
    }
    if ($company_phone == '' || !is_numeric($company_phone)) {
        $error = true;
        $errorMessage .= "need to fill company_phone<br>";
        $processError = true;
    }
    if ($company_email == '') {
        $error = true;
        $errorMessage .= "need to fill company_email<br>";
        $processError = true;
    } elseif (!filter_var($company_email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $errorMessage .= "Invalid email format for company_email<br>";
        $processError = true;
    }
    
    if ($point === "" ||  $company_name === "" || $company_phone === "" || $company_email === "") {
        $error = true;
        $errorMessage .= "Need to fill all fields<br>";
        $processError = true;
    }

    if ($processError == false) {
        // echo $id;
        // exit();

        if ($image['name'] == '') {

            if (!is_dir($uploadDir) || !file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $image_name = $uploadDir . uniqid() . date("d-m-y") . $_FILES['company_logo']['name'];
            $tmp_name = $_FILES['company_logo']['tmp_name'];
            if (checkImageExtension($image_name)) {
                move_uploaded_file($tmp_name, $image_name);
            }

            $sql = "INSERT INTO `setting`(`point`, `company_logo`, `company_name`, `company_phone`, `company_email`, `created_by`, `updated_by`) VALUES ('$point','$image_name','$company_name','$company_phone','$company_email','$user_id','$user_id')";
            $query = $mysqli->query($sql);

            if ($query) {
                $url = $adminBaseUrl . "show_setting.php";
                header("Refresh:0;url=$url");
                exit();
            } else {
                // Handle error if the query fails
                $error = true;
                $errorMessage .= "Error When Create: " . $mysqli->error . "</br>";
            }
        } else {
            if (!is_dir($uploadDir) || !file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $image_name = $uploadDir . uniqid() . date("d-m-y") . $_FILES['company_logo']['name'];
            $tmp_name = $_FILES['company_logo']['tmp_name'];
            move_uploaded_file($tmp_name, $image_name);

            $update_sql = "UPDATE `setting` SET point='$point', company_name='$company_name',company_logo='$image_name', company_email='$company_email',company_phone='$company_phone', updated_at=CURRENT_TIMESTAMP, updated_by='$user_id' WHERE id=$id";
            $update_query = $mysqli->query($update_sql);

            if ($query) {
                $url = $adminBaseUrl . "show_setting.php";
                header("Refresh:0;url=$url");
                exit();
            } else {
                // Handle error if the query fails
                $error = true;
                $errorMessage .= "Error When Create: " . $mysqli->error . "</br>";
            }
        }
    }
} else {
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
                    <h2>Create Setting<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="<?php echo $adminBaseUrl ?>create_setting.php" method="POST" enctype="multipart/form-data">

                        <!-- $point = $company_logo = $company_name = $company_phone = $company_email = ""; -->

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="point">point <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="point" placeholder="fill point" class="form-control" name="point" value="<?php echo $point; ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="file-upload">Upload Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="file-upload" placeholder="fill point" class="form-control" name="company_logo" accept="image/*" onchange="previewImage(event);" value="<?php echo $company_name; ?>">
                                <!-- <img id="preview-selected-image" style="display: none; max-width: 200px; margin-top: 10px;" onclick="fileBrowse()" /> -->
                                <img src="<?php echo $adminBaseUrl . $company_logo; ?>" id="preview-selected-image" style="width: 200px;height:150px;object-fit: cover;" onclick="fileBrowse()" />

                            </div>
                        </div>

                        <!-- <label for="file-upload">Upload Image</label>
                        <input type="file" name='company_logo' id="file-upload" accept="image/*" onchange="previewImage(event);" /> -->
                        <!-- company logo image  -->

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_name">company_name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="company_name" placeholder="fill company_name" class="form-control" name="company_name" value="<?php echo $company_name; ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_phone">company_phone <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="company_phone" placeholder="fill company_phone" class="form-control" name="company_phone" value="<?php echo $company_phone; ?>">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_email">company_email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="company_email" placeholder="fill company_email" class="form-control" name="company_email" value="<?php echo $company_email; ?>">
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

<script>
    // Image preview

    function fileBrowse() {
        $('#file-upload').click();
    }

    const previewImage = (event) => {
        const imageFiles = event.target.files;
        const imagePreviewElement = document.querySelector("#preview-selected-image");
        const imageSrc = URL.createObjectURL(imageFiles[0]);
        if (imageSrc) {
            imagePreviewElement.src = imageSrc;
            imagePreviewElement.style.display = "block";
        }
    };
</script>


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