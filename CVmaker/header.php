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
    <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
        <a href="dashboard.php" class="btn btn-outline-primary btn-auth me-2">Dashboard</a>
        <a href="logout.php" class="btn btn-danger btn-auth text-white">Logout</a>
    <?php else: ?>
        <a href="register.php" class="btn btn-link text-decoration-none text-dark fw-bold me-3">Register</a>
        <a href="login.php" class="btn btn-primary btn-auth text-white shadow-sm">Get Started</a>
    <?php endif; ?>
</div>
            </div>
        </div>
    </nav>