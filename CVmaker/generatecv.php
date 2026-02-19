<?php
include 'config.php';
session_start();

// 1. FETCH SYSTEM SETTINGS
$settings_query = mysqli_query($conn, "SELECT * FROM system_settings WHERE id = 1");
$sys = mysqli_fetch_assoc($settings_query);

// 2. CHECK MAINTENANCE MODE
if ($sys['maintenance_mode'] == 1) {
    header("Location: maintenance.php");
    exit();
}

// 3. SECURITY: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 4. CHECK PRINT LIMIT
$user_query = mysqli_query($conn, "SELECT cv_print_count FROM users WHERE id = '$user_id'");
$user_data = mysqli_fetch_assoc($user_query);

if ($user_data['cv_print_count'] >= $sys['print_limit']) {
    // Redirect to a "Limit Reached" error or show a message
    die("<div style='text-align:center; padding:50px; font-family:sans-serif;'>
            <h1 style='color:red;'>Download Limit Reached!</h1>
            <p>You have used your maximum limit of " . $sys['print_limit'] . " CV prints.</p>
            <p>Please contact Admin <b>Muhammad Bilal Ifzal</b> to upgrade your account.</p>
            <a href='user_dashboard.php'>Back to Dashboard</a>
         </div>");
}

// 5. IF ALL CHECKS PASS, PROCEED TO GENERATE CV
if (isset($_POST['generate'])) {
    
    // ... Your existing logic to collect form data (Name, Experience, etc.) ...

    // IMPORTANT: After successful generation/download, increment the user's print count
    mysqli_query($conn, "UPDATE users SET cv_print_count = cv_print_count + 1 WHERE id = '$user_id'");

    // Logic to load the template (Example)
    $template_name = "modern_blue.php"; // You can make this dynamic based on selection
    include "templates/" . $template_name;
    
    echo "Success! Your CV is being generated...";
}
?>