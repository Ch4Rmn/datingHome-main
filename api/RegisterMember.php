<?php
session_start();

require("../config/config.php");
require("../config/database.php");
require("../config/include_function.php");

$response = [];
$response['status'] = 500;
// var_dump($_POST);
// exit();
// {"name":"root","email":"root","password":"root","phone":"4314141341","birthday":"05\/02\/2024","education":"root","about":"root","city":" 6 ","gender":"1","partner_gender":"1","minAges":"31","maxAges":"54","hobbies":["1"]}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_data = file_get_contents("php://input");
    // json to string or obj  
    // var_dump($post_data);
    // exit;
    // after decode to string we got data indise $post_data  
    // $json_data = '{"name":"root","email":"root","password":"root","phone":"4314141341","birthday":"05\/02\/2024","education":"root","about":"root","city":" 6 ","gender":"1","partner_gender":"1","minAges":"31","maxAges":"54","hobbies":["1"]}';

    // Decode JSON data
    $decode_data = json_decode($post_data, true);

    $name = $mysqli->real_escape_string($decode_data['name']);
    $email = $mysqli->real_escape_string($decode_data['email']);
    $password = generatePass($mysqli->real_escape_string($decode_data['password']), $shaKey);
    $phone = $mysqli->real_escape_string($decode_data['phone']);
    $birthday = $mysqli->real_escape_string(date('Y-m-d', strtotime($decode_data['birthday'])));
    $email_confirm_code = getEmailConfirmCode();
    $education = $mysqli->real_escape_string($decode_data['education']);
    $about = $mysqli->real_escape_string($decode_data['about']);
    $city = (int)($decode_data['city']);
    $gender = (int)($decode_data['gender']);
    $partner_gender = (int)($decode_data['partner_gender']);
    $minAges = (int)($decode_data['minAges']);
    $maxAges = (int)($decode_data['maxAges']);
    $hobbies = ($decode_data['hobbies']);
    $heightFeet = (int)($decode_data['heightFeet']);
    $heightInches = (int)($decode_data['heightInches']);

    // // Accessing the "name" field
    // $name = $decode_data['name'];
    // $email = $decode_data['email'];
    // $password = generatePass($decode_data['password'], $shaKey);
    // $phone = $decode_data['phone'];
    // $birthday = $decode_data['birthday'];
    // $birthday = date('Y-m-d', strtotime($birthday));
    // $email_confirm_code = getEmailConfirmCode();
    // $education = $decode_data['education'];
    // $about = $decode_data['about'];
    // $city = $decode_data['city'];
    // $gender = $decode_data['gender'];
    // $partner_gender = $decode_data['partner_gender'];
    // $minAges = $decode_data['minAges'];
    // $maxAges = $decode_data['maxAges'];
    // $hobbies = $decode_data['hobbies'];
    // $heightFeet = $decode_data['heightFeet'];
    // $heightInches = $decode_data['heightInches'];

    // echo json_encode($city);
    // exit();
    // setting point
    $sql = "SELECT * FROM `setting`";
    $query = $mysqli->query($sql);
    $num_rows = $query->num_rows;
    // echo $num_rows;
    // exit;
    if ($num_rows > 0) {
        $row = $query->fetch_assoc();
        $point = $row['point'];
        // echo $point;
        // exit;
    }

    $sql = "INSERT INTO `members`(`name`, `password`, `email`, `phone`, `email_confirm_code`, `gender`, `partner_gender`, `heightFeet`, `heightInches`, `point`, `status`, `birthday`, `view_count`, `education`, `city_id`, `created_by`, `updated_by`, `minAges`, `maxAges`) 
    VALUES ('$name','$password','$email','$phone','$email_confirm_code','$gender','$partner_gender','$heightFeet','$heightInches','$point',0,'$birthday',0,'$education','$city',18,18,'$minAges','$maxAges')";
    // echo $sql;
    // exit();
    // $query = 
    $mysqli->query($sql);
    $insert_id = $mysqli->insert_id;
    foreach ($hobbies as $hobby) {
        # code...
        $sql = "INSERT INTO `member_hobbies`( `member_id`, `hobby_id`,`created_by`,`updated_by`)
         VALUES ('$insert_id','$hobby','$insert_id','$insert_id')";
        // echo $sql;
        // exit();
        $mysqli->query($sql);
    }
    // echo "insert id is " . $insert_id;
    $response['member_id'] = $insert_id;
    $response['status'] = 200;
    // if ($query) {
    //     $url = "http://localhost/datingHome-main/admin-backend/loginMember.php";
    //     header("Refresh:0;url=$url");
    //     exit();
    // }


    // echo $name;
    // exit();


    // You can now use $name variable as needed

    // You can now use $name variable as needed
    // $name = $decode_data['name'];

    // to check response in network
    // echo json_encode(
    //     // $heightFeet,
    //     // $heightInches,
    //     // $gender,
    //     // $partner_gender
    // );
}

echo json_encode($response);
