<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save_personal'])) {
    $user_id = $_SESSION['user_id'];
    
    // Catching all the new fields
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
    $portfolio = mysqli_real_escape_string($conn, $_POST['portfolio']);
    
    // Handle Profile Image Upload (Keep your existing image logic)
    $profile_img = "";
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_extension = pathinfo($_FILES["profile_img"]["name"], PATHINFO_EXTENSION);
        $new_filename = "user_" . $user_id . "_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)) {
            $profile_img = $new_filename;
        }
    }

    // Update Query including Name and Title
    $sql = "UPDATE users SET 
            full_name='$name', 
            title='$title', 
            phone='$phone', 
            address='$address', 
            summary='$summary', 
            linkedin='$linkedin', 
            portfolio='$portfolio'";
    
    if ($profile_img != "") {
        $sql .= ", profile_img='$profile_img'";
    }
    
    $sql .= " WHERE id='$user_id'";

    if ($conn->query($sql)) {
        header("Location: dashboard.php?status=success");
    } else {
        header("Location: dashboard.php?status=error");
    }
    exit();
}
?>