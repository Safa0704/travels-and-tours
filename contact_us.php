<?php
$db_hostname = "hostname";
$db_username = "username";
$db_password = "password"; 
$db_name = "tour";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

$sql = "INSERT INTO contact (Name, Email, Phone, Subject, Message) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $subject, $message);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: thank.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);
