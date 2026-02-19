<?php
session_start();
$actual_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
include("header.php");
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<style>
    /* Full-Width Classic Marquee Styling */
    .classic-marquee {
        width: 100%;
        background: #000;
        color: #fff;
        padding: 12px 0;
        overflow: hidden;
        white-space: nowrap;
        border-bottom: 2px solid #0d6efd;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .marquee-content {
        display: inline-block;
        padding-left: 100%;
        animation: marquee-scroll 30s linear infinite;
    }
    @keyframes marquee-scroll {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-100%, 0); }
    }

    .services-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #003d99 100%);
        padding: 100px 0;
        color: white;
        width: 100%;
    }
    
    .service-big-card {
        background: white;
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    .service-big-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
    .icon-box { width: 70px; height: 70px; background: rgba(13, 110, 253, 0.1); color: #0d6efd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 20px; }
</style>

<section class="services-hero text-center w-100">
    <div class="container" data-aos="fade-down">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Our Expert CV Services</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 800px;">
            At BilalCvMaker, we provide more than just a document. We provide a gateway to your professional future.
        </p>
    </div>
</section>

<div class="classic-marquee">
    <div class="marquee-content">
        🚀 NEW UPDATE VERSION COMING SOON! • POLICY: 1 USER FOR 1 CV • DEVELOPED BY MUHAMMAD BILAL IFZAL • STAY TUNED FOR PREMIUM FEATURES • 🚀 NEW UPDATE VERSION COMING SOON! • POLICY: 1 USER FOR 1 CV 
    </div>
</div>

<section class="py-5 bg-light w-100">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-magic"></i></div>
                    <h3 class="fw-bold mb-3">AI-Powered Builder</h3>
                    <p class="text-muted">A seamless interface that guides you in creating a high-impact CV.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-file-invoice"></i></div>
                    <h3 class="fw-bold mb-3">ATS Optimization</h3>
                    <p class="text-muted">Templates developed by Muhammad Bilal Ifzal to pass robot filters.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-big-card p-5 shadow-sm h-100">
                    <div class="icon-box"><i class="fas fa-graduation-cap"></i></div>
                    <h3 class="fw-bold mb-3">Student Support</h3>
                    <p class="text-muted">Generate professional CVs for free to start your career.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white w-100">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="zoom-in">
            <h2 class="fw-bold">How It Works</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 50px; height: 3px;"></div>
        </div>
        
        <div class="row g-4 text-center">
            <?php 
            $steps = [
                "01" => ["title" => "Create Account", "desc" => "Register in seconds."],
                "02" => ["title" => "Enter Details", "desc" => "Input your skills."],
                "03" => ["title" => "Pick Design", "desc" => "Select from 8+ templates."],
                "04" => ["title" => "Download PDF", "desc" => "Instantly export."]
            ];
            $delay = 100;
            foreach($steps as $count => $info): ?>
            <div class="col-md-3" data-aos="flip-left" data-aos-delay="<?php echo $delay; ?>">
                <div class="process-step">
                    <h2 class="display-1 fw-bold opacity-10"><?php echo $count; ?></h2>
                    <h5 class="fw-bold mt-2"><?php echo $info['title']; ?></h5>
                    <p class="small text-muted"><?php echo $info['desc']; ?></p>
                </div>
            </div>
            <?php $delay += 100; endforeach; ?>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: false });</script>