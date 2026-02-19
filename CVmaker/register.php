<?php
include 'config.php';
session_start();
$message = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        $message = "<div class='alert alert-danger border-0 shadow-sm animate__animated animate__shakeX'>Email already exists!</div>";
    } else {
        $sql = "INSERT INTO users (full_name, email, phone, address, password) 
                VALUES ('$name', '$email', '$phone', '$address', '$password')";
        
        if ($conn->query($sql)) {
            $message = "<div class='alert alert-success border-0 shadow-sm'>Registration successful! <a href='login.php' class='fw-bold text-decoration-none'>Login here</a></div>";
        } else {
            $message = "<div class='alert alert-danger border-0 shadow-sm'>Error: " . $conn->error . "</div>";
        }
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
        
        <a href="login.php" class="btn btn-primary btn-auth text-white shadow-sm">Join Free</a>
    
</div>
            </div>
        </div>
    </nav>

<style>
    .register-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 60px 0;
    }
    .register-card {
        border: none;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .register-card:hover {
        transform: translateY(-5px);
    }
    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        background-color: #fdfdfd;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        background-color: #fff;
    }
    .input-group-text {
        border-radius: 10px 0 0 10px;
        background-color: #fff;
        border-right: none;
        color: #0d6efd;
    }
    .form-control {
        border-radius: 0 10px 10px 0;
    }
    .btn-register {
        background: linear-gradient(45deg, #0d6efd, #0043a8);
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-register:hover {
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        transform: scale(1.02);
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #212529;
    }
</style>

<div class="register-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="register-card p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h2 class="section-title h1 mb-2">Create Your Profile</h2>
                        <p class="text-muted">Join <span class="text-primary fw-bold">BilalCvMaker</span> and build a CV that gets noticed.</p>
                    </div>

                    <?php echo $message; ?>

                    <form action="register.php" method="POST">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="full_name" class="form-control" placeholder="Muhammad Bilal Ifzal" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="name@domain.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" class="form-control" placeholder="+92 XXX XXXXXXX" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Current Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" name="address" class="form-control" placeholder="Street, City, Country" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Secure Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                                <small class="text-muted">Must be at least 8 characters long.</small>
                            </div>

                            <div class="col-md-12 mt-5">
                                <button type="submit" name="register" class="btn btn-primary btn-register w-100 text-white shadow-sm">
                                    GET STARTED FOR FREE <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Already have an account? <a href="login.php" class="text-primary fw-bold text-decoration-none">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>