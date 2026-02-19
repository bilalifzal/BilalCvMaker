<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body { background: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .accordion-item { border: none; margin-bottom: 15px; border-radius: 12px !important; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .accordion-button { font-weight: 600; color: #4e73df; }
        .accordion-button:not(.collapsed) { background: #eef2ff; color: #4e73df; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5 animate__animated animate__fadeIn">
        <h2 class="display-6 fw-bold">Common Questions</h2>
        <p class="text-muted">Everything you need to know about BilalCvMaker</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 animate__animated animate__zoomIn">
            <div class="accordion" id="cvFaq">
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#f1">How do I download my CV?</button></h2>
                    <div id="f1" class="accordion-collapse collapse show" data-bs-parent="#cvFaq">
                        <div class="accordion-body">Once you complete all sections (Personal, Education, Skills, etc.), click the <strong>Preview CV</strong> button. From there, you can use the "Print to PDF" function to save it.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">Is my data safe?</button></h2>
                    <div id="f2" class="accordion-collapse collapse" data-bs-parent="#cvFaq">
                        <div class="accordion-body">Yes. We use advanced encryption and secure database management to ensure your private professional information remains private.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>