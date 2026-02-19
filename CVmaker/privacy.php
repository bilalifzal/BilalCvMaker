<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root { --primary-color: #4e73df; --dark-bg: #1a1e21; }
        body { background: #f4f7f6; font-family: 'Playfair Display', serif; color: #333; }
        
        /* Classic Typography Styling */
        h2 { font-family: 'Georgia', serif; font-weight: 700; letter-spacing: -1px; }
        .content-card { 
            background: white; 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .content-card:hover { transform: translateY(-5px); }
        
        .policy-section h5 { 
            color: var(--primary-color); 
            font-weight: bold; 
            border-left: 4px solid var(--primary-color); 
            padding-left: 15px; 
            margin-top: 30px;
        }
        
        /* Smooth Fade In */
        .reveal { animation: fadeInUp 1s; }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="text-center mb-5 animate__animated animate__fadeIn">
                <span class="badge bg-primary-soft text-primary px-3 py-2 mb-2 rounded-pill" style="background: rgba(78,115,223,0.1)">LEGAL DOCUMENTS</span>
                <h2 class="display-5 text-dark">Privacy Policy</h2>
                <div class="mx-auto" style="width: 60px; height: 3px; background: var(--primary-color);"></div>
            </div>

            <div class="card content-card p-4 p-md-5 reveal">
                <p class="lead text-muted mb-4">Your privacy is the cornerstone of our relationship. Below is how we protect your professional data.</p>
                
                <div class="policy-section">
                    <h5><i class="fas fa-shield-alt me-2"></i> 1. Information Security</h5>
                    <p>At BilalCvMaker, we encrypt your sensitive details using SSL technology. Your CV data is stored in isolated databases to ensure no unauthorized access occurs.</p>

                    <h5><i class="fas fa-user-check me-2"></i> 2. User Ownership</h5>
                    <p>You own 100% of your data. We do not claim any rights to the resumes you build, and you can delete your account and all associated data permanently at any time.</p>

                    <h5><i class="fas fa-eye-slash me-2"></i> 3. No Third-Party Selling</h5>
                    <p>Unlike other builders, we never sell your email or phone number to recruiters or marketing agencies without your direct "Opt-in" request.</p>
                </div>

                <div class="mt-5 p-4 rounded bg-light border-start border-primary border-4">
                    <p class="mb-0 small italic text-muted">Questions about our privacy practices? Contact our Data Protection Officer at <strong>legal@bilalcvmaker.com</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>