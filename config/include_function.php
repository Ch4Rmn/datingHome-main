<?php 
require_once('config.php');


function generatePass($password,$shaKey){
$strongPass = md5($shaKey . md5($password));
return $strongPass;
}

function checkImageExtension($image_name)
{
    $allow_extension = ['jpg', 'png', 'gif', 'jpeg'];
    $explode = explode('.', $image_name);
    $extension = strtolower(end($explode));

    if (in_array($extension, $allow_extension)) {
        return true;
    } else {
        return false;
    }
}
?>