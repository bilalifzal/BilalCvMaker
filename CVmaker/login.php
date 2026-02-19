<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            
          
            header("Location: useracc.php"); 
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #1a237e; /* Classic Navy */
            --accent-blue: #0d6efd;
            --light-bg: #f8f9fa;
        }
        body { font-family: 'Lato', sans-serif; background-color: var(--light-bg); display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar Styling */
        .navbar { background: #ffffff; box-shadow: 0 2px 15px rgba(0,0,0,0.1); py: 1rem; }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.7rem; color: var(--primary-dark) !important; }
        .navbar-brand span { color: var(--accent-blue); }
        .nav-link { font-weight: 600; color: #444 !important; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 0.5px; margin: 0 10px; }
        .nav-link:hover { color: var(--accent-blue) !important; }
        .btn-auth { border-radius: 50px; padding: 8px 25px; font-weight: 700; transition: 0.3s; }
        
        /* Card Styling for Login/Register */
        .classic-card { border: none; border-radius: 0; box-shadow: 0 20px 40px rgba(0,0,0,0.08); background: #ffffff; border-top: 4px solid var(--primary-dark); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-file-signature me-2"></i>Bilal<span>CvMaker</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="template.php">Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.php">CV Services</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                </ul>
       <div class="d-flex align-items-center">
        
        <a href="register.php" class="btn btn-primary btn-auth text-white shadow-sm">Create New Account</a>
    
</div>
            </div>
        </div>
    </nav>
    
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
        transition: transform 0.3s ease;
    }
    .login-card:hover {
        transform: translateY(-5px);
    }
    .form-control {
        border-radius: 0 10px 10px 0;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        background-color: #fdfdfd;
        border-left: none;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
        background-color: #fff;
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
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        transform: scale(1.02);
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #212529;
    }
</style>

<div class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h2 class="section-title h1 mb-2">Welcome Back</h2>
                        <p class="text-muted">Sign in to your <span class="text-primary fw-bold">BilalCvMaker</span> account</p>
                    </div>

                    <?php if(isset($_GET['success'])) echo "<div class='alert alert-success border-0 shadow-sm mb-4'>Account created! Please login.</div>"; ?>
                    <?php if(isset($error)) echo "<div class='alert alert-danger border-0 shadow-sm mb-4'>$error</div>"; ?>

                    <form action="login.php" method="POST">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="name@domain.com" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <button type="submit" name="login" class="btn btn-primary btn-login w-100 text-white shadow-sm">
                                    LOGIN NOW <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">New here? <a href="register.php" class="text-primary fw-bold text-decoration-none">Create an Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>