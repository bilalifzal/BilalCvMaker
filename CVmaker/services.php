<?php
session_start();
// Trick the header to show Guest navigation
$actual_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); 
}

include("header.php");

// Restore session
if ($actual_user) {
    $_SESSION['user_id'] = $actual_user;
}
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div style="background: #e9ecef; color: #0d6efd; padding: 10px 0; border-bottom: 1px solid #dee2e6;">
    <marquee behavior="alternate" scrollamount="4">
        <b>💡 TIP: 1 User per 1 CV ensures maximum security • Developed by Muhammad Bilal Ifzal • Premium Update Coming Soon!</b>
    </marquee>
</div>

<style>
    .services-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #003d99 100%);
        padding: 100px 0;
        color: white;
    }
    
    .service-big-card {
        background: white;
        border-radius: 20px;
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .service-big-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }

    .icon-box {
        width: 70px;
        height: 70px;
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .process-step {
        position: relative;
        padding: 20px;
    }
    
    .step-count {
        font-size: 4rem;
        font-weight: 900;
        color: rgba(13, 110, 253, 0.05);
        position: absolute;
        top: -10px;
        left: 20px;
        z-index: 0;
    }

    .benefit-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
    }
    
    .benefit-list i {
        color: #198754;
        margin-right: 10px;
    }
</style>

<section class="services-hero text-center">
    <div class="container" data-aos="zoom-in">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown" style="font-family: 'Playfair Display', serif;">Our Expert CV Services</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 800px;">
            At BilalCvMaker, we provide more than just a document. We provide a gateway to your professional future, designed and developed by Muhammad Bilal Ifzal.
        </p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-magic"></i></div>
                    <h3 class="fw-bold mb-3">AI-Powered Builder</h3>
                    <p class="text-muted">A seamless, step-by-step interface that guides you in creating a high-impact CV without the stress of formatting.</p>
                    <ul class="list-unstyled benefit-list mt-4">
                        <li><i class="fas fa-check-circle"></i> Real-time PDF preview</li>
                        <li><i class="fas fa-check-circle"></i> Auto-fill suggestions</li>
                        <li><i class="fas fa-check-circle"></i> 100% Mobile responsive</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-file-invoice"></i></div>
                    <h3 class="fw-bold mb-3">ATS Optimization</h3>
                    <p class="text-muted">Our templates are developed by Muhammad Bilal Ifzal using standard structures that pass Applicant Tracking Systems with ease.</p>
                    <ul class="list-unstyled benefit-list mt-4">
                        <li><i class="fas fa-check-circle"></i> Machine-readable fonts</li>
                        <li><i class="fas fa-check-circle"></i> Standard section headers</li>
                        <li><i class="fas fa-check-circle"></i> Clean, minimalist code</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-graduation-cap"></i></div>
                    <h3 class="fw-bold mb-3">Student Support</h3>
                    <p class="text-muted">Dedicated specifically to students and fresh graduates. Generate professional CVs for free to start your career.</p>
                    <ul class="list-unstyled benefit-list mt-4">
                        <li><i class="fas fa-check-circle"></i> Entry-level focus</li>
                        <li><i class="fas fa-check-circle"></i> No hidden subscriptions</li>
                        <li><i class="fas fa-check-circle"></i> Internship-ready designs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">How It Works</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 50px; height: 3px;"></div>
        </div>
        
        <div class="row g-4 text-center">
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="process-step">
                    <div class="step-count">01</div>
                    <h5 class="fw-bold mt-4">Create Account</h5>
                    <p class="small text-muted">Register in seconds to save your progress and manage multiple CVs.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="process-step">
                    <div class="step-count">02</div>
                    <h5 class="fw-bold mt-4">Enter Details</h5>
                    <p class="small text-muted">Input your education, skills, and experience into our simple form.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="process-step">
                    <div class="step-count">03</div>
                    <h5 class="fw-bold mt-4">Pick Design</h5>
                    <p class="small text-muted">Select from 8+ premium templates created by Muhammad Bilal Ifzal.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="process-step">
                    <div class="step-count">04</div>
                    <h5 class="fw-bold mt-4">Download PDF</h5>
                    <p class="small text-muted">Instantly export your professional CV and start applying to jobs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4" data-aos="zoom-out">
        <h2 class="mb-4 " style="font-family: 'Playfair Display', serif;">Elevate Your Career Today</h2>
        <p class="mb-5 opacity-75">Join thousands of students getting hired with BilalCvMaker's professional tools.</p>
        <a href="register.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow">Get Started for Free</a>
    </div>
</section>

<?php include("footer.php"); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: false });
</script>