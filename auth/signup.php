<?php


include "../connect.php";

$username = filterRequest("username");
$email = filterRequest("email");
$password = sha1("password");
$phone = filterRequest("phone");
$verifycode = filterRequest("verifycode");

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ? ");
$stmt->execute(array($email , $phone));
$count = $stmt->rowcount();
if($count > 0){
    printFailure("PHONE OR EMAIL");
}else{

    $data = array(
        "users_name" => $username,
        "users_email" => $email,
        "users_phone" => $phone,
        "users_password" => $password,
        "users_verifycode" => $verifycode,
    );

    insertData("users" , $data);
}

