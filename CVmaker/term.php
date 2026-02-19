<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root { --primary-color: #4e73df; }
        body { background: #f4f7f6; font-family: 'Segoe UI', serif; color: #333; }
        h2 { font-family: 'Georgia', serif; font-weight: 700; }
        .content-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
        .term-number { width: 40px; height: 40px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="text-center mb-5 animate__animated animate__fadeInDown">
                <h2 class="display-5">Terms of Service</h2>
                <p class="text-muted italic">Effective as of January 2024</p>
            </div>

            <div class="card content-card p-4 p-md-5 animate__animated animate__fadeInUp">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="term-number">1</div>
                        <h5 class="fw-bold">Acceptance of Terms</h5>
                        <p>By accessing BilalCvMaker, you agree to be bound by these terms. If you disagree with any part of the terms, you may not access our CV building services.</p>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="term-number">2</div>
                        <h5 class="fw-bold">User Content</h5>
                        <p>You are solely responsible for the information you enter. We do not verify the accuracy of your work history or certifications. Misrepresentation of your qualifications is your legal responsibility.</p>
                    </div>
                    <div class="col-12">
                        <div class="term-number">3</div>
                        <h5 class="fw-bold">Service Limitations</h5>
                        <p>We provide templates and a builder interface. We do not guarantee employment, job interviews, or specific career outcomes from using our generated documents.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>