<?php
session_start();
$actual_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); 
}
include("header.php");
if ($actual_user) {
    $_SESSION['user_id'] = $actual_user;
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    .about-hero {
        background: #f8f9fa;
        padding: 100px 0;
        border-bottom: 1px solid #eee;
    }
    .owner-image {
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 10px solid white;
        transition: 0.5s;
    }
    .owner-image:hover { transform: rotate(2deg) scale(1.02); }
    
    .mission-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        height: 100%;
        border-bottom: 4px solid #0d6efd;
        transition: 0.3s;
    }
    .mission-card:hover { transform: translateY(-10px); }

    .stats-circle {
        width: 120px;
        height: 120px;
        border: 4px solid #0d6efd;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: 0.5s;
    }
    .mission-card:hover .stats-circle { background: #0d6efd; color: white; }

    .signature {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 1.5rem;
        color: #0d6efd;
    }

    /* Fast Marquee for Skills/About */
    .skills-marquee {
        background: #0d6efd;
        color: white;
        padding: 10px 0;
        overflow: hidden;
    }
    .marquee-inner {
        display: flex;
        width: 200%;
        animation: scroll 15s linear infinite;
    }
    .marquee-inner span {
        width: 100%;
        display: flex;
        justify-content: space-around;
        font-weight: bold;
    }
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start animate__animated animate__fadeInLeft">
                <h6 class="text-primary fw-bold text-uppercase mb-3" style="letter-spacing: 3px;">The Story Behind</h6>
                <h1 class="display-3 fw-bold mb-4" style="font-family: 'Playfair Display', serif;">BilalCvMaker</h1>
                <p class="lead text-muted mb-4">A platform born out of a passion for coding and a commitment to student success, built entirely by one developer.</p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                    <div class="text-center px-3">
                        <h4 class="fw-bold mb-0">100%</h4>
                        <small class="text-muted">Student Focused</small>
                    </div>
                    <div class="vr"></div>
                    <div class="text-center px-3">
                        <h4 class="fw-bold mb-0">Free</h4>
                        <small class="text-muted">Forever</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop" alt="Development" class="img-fluid owner-image">
            </div>
        </div>
    </div>
</section>

<div style="background: #000; color: #fff; padding: 5px 0; font-size: 14px; font-weight: bold;">
    <marquee behavior="scroll" direction="left" scrollamount="6">
         NEW UPDATE VERSION COMING SOON! • This platform is totally developed by Muhammad Bilal Ifzal • Policy: 1 User for 1 CV to ensure quality and security • Stay Tuned for More Premium Templates! 
         NEW UPDATE VERSION COMING SOON! • This platform is totally developed by Muhammad Bilal Ifzal • Policy: 1 User for 1 CV to ensure quality and security • Stay Tuned for More Premium Templates!
    </marquee>
</div>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5 animate__animated animate__fadeInUp">
                <div class="p-5 bg-dark text-white rounded-5 shadow-lg h-100 d-flex flex-column justify-content-center">
                    <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">Meet the Developer</h2>
                    <p class="opacity-75">"I saw many students struggling to format their resumes while job hunting. I decided to use my skills to build a tool that removes that barrier. BilalCvMaker is my contribution to the student community."</p>
                    <div class="mt-4">
                        <h5 class="mb-0 fw-bold">Muhammad Bilal Ifzal</h5>
                        <small class="text-primary">Founder & Full Stack Developer</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 animate__animated animate__fadeIn">
                <h3 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">My Vision</h3>
                <p class="text-muted">Hello! I am <b>Muhammad Bilal Ifzal</b>. I designed and developed this entire platform from scratch with a single goal: to provide students with premium-quality CV tools without the premium price tag.</p>
                <p class="text-muted">In today's competitive job market, your CV is your first impression. Many professional builders charge high subscription fees that students simply cannot afford. <b>BilalCvMaker</b> changes that by offering professional, ATS-optimized templates absolutely free of charge.</p>
                
                <div class="row mt-5 g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-code fa-2x text-primary me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold">Independent Coding</h6>
                                <p class="small text-muted">Built using modern web technologies to ensure speed, security, and a smooth user experience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-heart fa-2x text-danger me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold">Community Driven</h6>
                                <p class="small text-muted">This project is a labor of love, dedicated to helping fresh graduates land their first big break.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">Our Core Values</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 50px; height: 3px;"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 animate__animated animate__slideInUp" style="animation-delay: 0.1s;">
                <div class="mission-card text-center">
                    <div class="stats-circle">
                        <i class="fas fa-eye fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Transparency</h5>
                    <p class="small text-muted">No hidden costs, no "trial periods," and no watermarks on your professional documents.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__slideInUp" style="animation-delay: 0.2s;">
                <div class="mission-card text-center">
                    <div class="stats-circle">
                        <i class="fas fa-rocket fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Efficiency</h5>
                    <p class="small text-muted">Go from an empty profile to a finished, high-quality PDF resume in less than 10 minutes.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <div class="mission-card text-center">
                    <div class="stats-circle">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Privacy</h5>
                    <p class="small text-muted">Your personal data is yours. We ensure your information is kept secure and never sold.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop" 
                         class="img-fluid rounded-5 shadow-lg" alt="About BilalCvMaker">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 rounded-4 shadow mb-n3 ms-n3 d-none d-md-block">
                        <h3 class="fw-bold mb-0">100%</h3>
                        <p class="small mb-0">Free for Students</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <h6 class="text-primary fw-bold text-uppercase" style="letter-spacing: 2px;">Web Developer</h6>
                <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.8rem;">Meet Muhammad Bilal Ifzal</h2>
                <p class="lead text-dark fw-semibold">Independent Developer & Visionary Behind BilalCvMaker.</p>
                <p class="text-muted">
                    This platform was built from the ground up by **Muhammad Bilal Ifzal**. Driven by a passion for technology and a desire to give back to the community, Bilal developed this website entirely on his own. 
                </p>
                <p class="text-muted">
                    The mission is simple: **Empowering Students.** Bilal understands the challenges students face when entering the professional world. That’s why this website is dedicated to providing high-quality, premium-standard CVs completely for free, helping the next generation land their dream jobs without any financial barriers.
                </p>
                <div class="row g-3 mt-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle p-2 rounded-circle me-3">
                                <i class="fas fa-code text-primary"></i>
                            </div>
                            <span class="fw-bold">Self-Developed</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle p-2 rounded-circle me-3">
                                <i class="fas fa-graduation-cap text-primary"></i>
                            </div>
                            <span class="fw-bold">Student Focused</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
    }
    #about p { line-height: 1.8; }
</style>

<section class="py-5 bg-white text-center">
    <div class="container py-4 " style="animation-duration: 3s;">
        <h2 class="fw-bold mb-4">Start Your Career Journey Today</h2>
        <a href="register.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold shadow">Create My Free CV</a>
        <p class="mt-4 signature">Muhammad Bilal Ifzal</p>
    </div>
</section>

<?php include("footer.php"); ?>