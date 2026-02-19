<?php
include 'config.php';
session_start();

$error = "";
// Manage the 3-step flow via sessions
if (!isset($_SESSION['admin_gate'])) {
    $_SESSION['admin_gate'] = 1;
}
$step = $_SESSION['admin_gate'];

// STEP 1: Primary Credentials
if (isset($_POST['admin_login_step1'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if ($email === "mbilalifzal82@gmail.com" && $password === "igi23111") {
        $_SESSION['admin_gate'] = 2;
        header("Location: admin_login.php");
        exit();
    } else {
        $error = "Invalid Credentials!";
    }
}

// STEP 2: Final Security Key
if (isset($_POST['admin_login_step2'])) {
    $final_key = $_POST['final_password'];

    if ($final_key === "23112311") {
        $_SESSION['admin_gate'] = 3;
        header("Location: admin_login.php");
        exit();
    } else {
        $error = "Security Key Incorrect!";
    }
}

// STEP 3: Identity Verification (Hardcoded strict check)
if (isset($_POST['admin_login_step3'])) {
    $name = trim($_POST['admin_name']);
    $cnic = trim($_POST['admin_cnic']);
    $dob  = $_POST['admin_dob'];
    $encrypt_key = $_POST['encrypt_key'];

    if (
        $name === "Muhammad Bilal Ifzal" && 
        $cnic === "3310037101209" && 
        $dob  === "2005-12-25" && 
        $encrypt_key === "bilal2311"
    ) {
        $_SESSION['admin_logged_in'] = true;
        unset($_SESSION['admin_gate']); // Clear gate
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Identity Verification Failed! Data mismatch.";
    }
}

include 'header.php'; 
?>

<style>
    .login-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 80px 0;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }
    .login-card {
        border: none;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .form-control {
        border-radius: 0 10px 10px 0;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        background-color: #fdfdfd;
        border-left: none;
    }
    .input-group-text {
        border-radius: 10px 0 0 10px;
        background-color: #fff;
        border-right: none;
        color: #0d6efd;
    }
    .btn-login {
        background: linear-gradient(45deg, #0d6efd, #0043a8);
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-weight: 600;
        color: white;
    }
    .section-title { font-family: 'Playfair Display', serif; font-weight: 700; color: #212529; }
</style>

<div class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h2 class="section-title h1 mb-2">Admin Portal</h2>
                        <p class="text-muted">Verification Phase: <span class="text-primary fw-bold"><?php echo $step; ?> / 3</span></p>
                    </div>

                    <?php if($error) echo "<div class='alert alert-danger border-0 shadow-sm mb-4 text-center'>$error</div>"; ?>

                    <?php if($step == 1): ?>
                    <form action="admin_login.php" method="POST">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" name="admin_login_step1" class="btn btn-login w-100 shadow-sm">CONTINUE <i class="fas fa-chevron-right ms-2"></i></button>
                            </div>
                        </div>
                    </form>

                    <?php elseif($step == 2): ?>
                    <form action="admin_login.php" method="POST">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Final Security Key</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" name="final_password" class="form-control" placeholder="Enter Key" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" name="admin_login_step2" class="btn btn-login w-100 shadow-sm">VERIFY KEY <i class="fas fa-lock-open ms-2"></i></button>
                            </div>
                        </div>
                    </form>

                    <?php elseif($step == 3): ?>
                    <form action="admin_login.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="admin_name" class="form-control rounded" placeholder="Full Name" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">CNIC</label>
                                <input type="text" name="admin_cnic" class="form-control rounded" placeholder="CNIC Number" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">DOB</label>
                                <input type="date" name="admin_dob" class="form-control rounded" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-danger">Encrypt Key</label>
                                <input type="password" name="encrypt_key" class="form-control rounded" placeholder="Secret Key" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" name="admin_login_step3" class="btn btn-login w-100 shadow-sm" style="background: #212529;">FINALIZE ACCESS</button>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>

                    <div class="text-center mt-4">
                        <a href="logout.php" class="text-muted small text-decoration-none">Reset & Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>