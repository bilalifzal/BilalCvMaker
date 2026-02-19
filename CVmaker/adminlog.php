<?php
include 'config.php';
session_start();

if (isset($_POST['login_step1'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $res = mysqli_query($conn, "SELECT * FROM admin_users WHERE email='$email'");
    $admin = mysqli_fetch_assoc($res);

    if ($admin && password_verify($pass, $admin['password'])) {
        $_SESSION['admin_step1'] = true;
        $_SESSION['admin_email'] = $email;
    } else { $error = "Invalid Credentials"; }
}

if (isset($_POST['login_step2'])) {
    $secret = $_POST['final_password'];
    $email = $_SESSION['admin_email'];
    $res = mysqli_query($conn, "SELECT * FROM admin_users WHERE email='$email'");
    $admin = mysqli_fetch_assoc($res);

    if ($admin['final_secret_key'] == $secret) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
    } else { $error = "Wrong Final Password!"; }
}
?>
<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 shadow">
        <h4 class="text-center mb-4">Admin Security</h4>
        <?php if(!isset($_SESSION['admin_step1'])): ?>
            <form method="POST">
                <input type="email" name="email" class="form-control mb-3" placeholder="Admin Email" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button name="login_step1" class="btn btn-primary w-100">Next Step</button>
            </form>
        <?php else: ?>
            <form method="POST">
                <p class="text-success text-center">Identity Verified. Enter Security Key:</p>
                <input type="password" name="final_password" class="form-control mb-3" placeholder="Final Password" required>
                <button name="login_step2" class="btn btn-danger w-100">Unlock Panel</button>
            </form>
        <?php endif; ?>
    </div>
</div>