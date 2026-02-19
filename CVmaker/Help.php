<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { background: #f4f7f6; }
        .help-box { background: white; border-radius: 20px; border: none; transition: 0.3s; height: 100%; }
        .help-box:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(78,115,223,0.1); }
        .icon-circle { width: 70px; height: 70px; background: rgba(78,115,223,0.1); color: #4e73df; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h2 class="fw-bold">How can we support you today?</h2>
        <p class="text-muted">Our team is here to help you build your future.</p>
    </div>

    <div class="row g-4 animate__animated animate__fadeInUp">
        <div class="col-md-4">
            <div class="card help-box p-4 text-center">
                <div class="icon-circle"><i class="fas fa-book-open fa-2x"></i></div>
                <h5>Guides & Tutorials</h5>
                <p class="small text-muted">Step-by-step instructions on how to optimize your resume for ATS systems.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card help-box p-4 text-center">
                <div class="icon-circle"><i class="fas fa-headset fa-2x"></i></div>
                <h5>Direct Support</h5>
                <p class="small text-muted">Having technical issues? Email our developers directly at support@bilalcvmaker.com</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card help-box p-4 text-center">
                <div class="icon-circle"><i class="fas fa-user-lock fa-2x"></i></div>
                <h5>Account Security</h5>
                <p class="small text-muted">Recover lost passwords or update your privacy settings here.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>