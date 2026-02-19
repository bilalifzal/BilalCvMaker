<?php
session_start();
// This is the Home Page - we want it to look like a landing page (Before Login)
// We temporarily store the user_id if it exists, then unset it just for this page's header logic
$actual_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$temp_session = $_SESSION;

// Logic to force the header to show "Login/Register" instead of "Logout"
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); 
}

// Include your custom header (it will now show Login/Register because user_id is unset)
include("header.php");

// Restore the session immediately after header is included so the rest of the site works
if ($actual_user) {
    $_SESSION['user_id'] = $actual_user;
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* --- NEW CLASSIC ANIMATIONS & STYLES --- */
    html { scroll-behavior: smooth; }
    body { overflow-x: hidden; }

    /* Classic Marquee Ticker */
    .top-marquee {
        background: #212529;
        color: #fff;
        padding: 8px 0;
        font-size: 0.85rem;
        font-weight: 500;
        border-bottom: 2px solid #0d6efd;
    }

    /* Animation Delays */
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }

    /* --- YOUR ORIGINAL STYLES (Preserved Exactly) --- */
    .hero-section {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(244, 247, 249, 0.9)), 
                    url('https://images.unsplash.com/photo-1586281380349-632531db7ed4?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: #212529;
    }
    .hero-title span { color: #0d6efd; }
    
    .feature-card {
        border: none;
        padding: 40px 20px;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(13, 110, 253, 0.1);
    }
    .feature-icon {
        font-size: 2.5rem;
        color: #0d6efd;
        margin-bottom: 20px;
    }

    .step-number {
        width: 50px; height: 50px; background: #0d6efd; color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-weight: bold; margin: 0 auto 20px;
    }

    .index-template-card { transition: transform 0.3s ease; margin-bottom: 30px; }
    .mini-cv-sheet {
        background: #fff; aspect-ratio: 1 / 1.41; width: 100%; border-radius: 6px;
        border: 1px solid #ddd; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 12px; position: relative; overflow: hidden; text-align: left;
    }
    .index-template-card:hover { transform: translateY(-10px); }
    .index-template-card:hover .mini-cv-sheet { box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color: #0d6efd; }
    .mini-content-box { font-size: 4px; color: #444; line-height: 1.2; opacity: 0.9; }
    .mini-name { font-size: 8px; font-weight: 900; color: #111; margin-bottom: 2px; }
    .mini-title { font-size: 5px; font-weight: 600; color: #0d6efd; margin-bottom: 2px; }
    .mini-contact { font-size: 3.5px; color: #888; margin-bottom: 4px; }
    .mini-hr { margin: 4px 0; background: #eee; height: 1px; border: none; }
    .mini-label { font-size: 4.5px; font-weight: bold; color: #000; display: block; margin-top: 5px; margin-bottom: 2px; border-bottom: 0.5px solid #eee; }
    .mini-text-block { margin-bottom: 6px; }
    .mini-pill { background: #f0f0f0; border: 0.2px solid #ddd; padding: 1px 3px; border-radius: 1px; font-size: 3px; display: inline-block; }

    .style-modern.mini-cv-sheet { border-top: 5px solid #0d6efd; }
    .style-executive.mini-cv-sheet { text-align: center; }
    .style-executive .mini-label { border-bottom: none; background: #222; color: #fff; padding: 1px; }
    .style-royal.mini-cv-sheet { border: 1.5px solid #b8860b; }
    .style-cyber.mini-cv-sheet { border-left: 5px solid #00d2d3; }
    .style-pro-dark.mini-cv-sheet { background: #212529; }
    .style-pro-dark .mini-content-box { color: #f8f9fa; }
    .style-pro-dark .mini-name { color: #fff; }

    .mini-sheet-hover {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(13, 110, 253, 0.5); display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: 0.3s;
    }
    .index-template-card:hover .mini-sheet-hover { opacity: 1; }

    @media (max-width: 576px) { #btnst{ flex-direction:column; } }

    .service-card { transition: all 0.3s ease-in-out; }
    .service-card:hover { transform: translateY(-12px); box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important; }
    .service-icon-wrapper {
        width: 80px; height: 80px; background: rgba(13, 110, 253, 0.05);
        border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;
    }

    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
        display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;
    }
    #about p { line-height: 1.8; }
</style>



<section class="hero-section animate__animated animate__fadeIn">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="hero-title mb-4 animate__animated animate__zoomIn delay-1">Craft Your Future with <span>BilalCvMaker</span></h1>
                <p class="lead text-muted mb-5 animate__animated animate__fadeInUp delay-2">Create a professional, job-winning resume in minutes with our elegant templates and easy-to-use builder.</p>
                <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp delay-3" id='btnst'>
                    <a href="register.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Build My CV Now</a>
                    <a href="template.php" class="btn btn-dark btn-lg px-5 py-3 rounded-pill">View Templates</a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="top-marquee">
    <marquee behavior="scroll" direction="left" scrollamount="7">
        🚀 NEW: 8+ Premium ATS-Friendly Templates Added! &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; 
        🎓 Dedicated to Student Success - 100% Free Forever &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; 
        ⭐ Trusted by thousands of job seekers globally &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; 
        🛠️ Built by Muhammad Bilal Ifzal
    </marquee>
</div>
<style>
    /* Mobile Grid Fix: 2 items per row */
    @media (max-width: 767px) {
        .row-cols-mobile-2 > * {
            flex: 0 0 50% !important;
            max-width: 50% !important;
            padding: 8px !important; /* Smaller padding for mobile */
        }
        .mini-name { font-size: 5px !important; }
        .mini-text-block { font-size: 2px !important; line-height: 1.1 !important; }
        .index-template-card h6 { font-size: 0.85rem; }
    }

    .index-template-card {
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .mini-cv-sheet {
        background: white;
        aspect-ratio: 1 / 1.41;
        width: 100%;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        border: 1px solid #eee;
        padding: 10px;
        cursor: pointer;
    }

    /* Ultra-dense micro-text to fill the entire page */
    .mini-name { font-size: 6px; font-weight: 800; color: #000; text-transform: uppercase; margin-bottom: 1px; }
    .mini-title { font-size: 3.5px; color: #0d6efd; font-weight: bold; margin-bottom: 2px; }
    .mini-contact { font-size: 2.2px; color: #777; margin-bottom: 3px; }
    .mini-hr { margin: 3px 0; opacity: 0.1; }
    .mini-text-block { font-size: 2.4px; color: #444; margin-bottom: 4px; line-height: 1.2; text-align: justify; }
    .mini-label { font-size: 2.8px; font-weight: 800; color: #000; display: block; margin-bottom: 1px; border-bottom: 0.1px solid #eee; }
    .mini-pill { font-size: 2px; background: #f0f0f0; padding: 1px 3px; border-radius: 2px; }

    /* Theme Styles */
    .style-modern { border-top: 3px solid #0d6efd; }
    .style-executive { border-top: 3px solid #1a1a1a; text-align: center; }
    .style-royal { background: #fffdf9; border: 0.5px solid #b8860b; }
    .style-pro-dark { background: #2d3436; color: #fff; border: none; }
    .style-pro-dark .mini-name, .style-pro-dark .mini-text-block, .style-pro-dark .mini-label { color: #fff; }

    .mini-sheet-hover {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); display: flex; align-items: center;
        justify-content: center; opacity: 0; transition: 0.3s;
    }
    .mini-cv-sheet:hover .mini-sheet-hover { opacity: 1; }
</style>

<section id="templates" class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">Pick a Professional Template</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 60px; height: 3px;"></div>
            <p class="text-muted mt-3">All designs are optimized for ATS and recognized by top employers.</p>
        </div>
        
        <div class="row row-cols-2 row-cols-md-4 g-4 px-lg-4 row-cols-mobile-2">
            <?php 
            $index_templates = [
                'modern' => ['name' => 'Modern Blue', 'desc' => 'Clean & Professional'],
                'executive' => ['name' => 'Executive', 'desc' => 'Corporate Standard'],
                'minimal' => ['name' => 'Minimalist', 'desc' => 'Creative Layout'],
                'enthusiast' => ['name' => 'Enthusiast', 'desc' => 'Bold & Vibrant'],
                'royal' => ['name' => 'Royal Gold', 'desc' => 'Elegant Serif'],
                'cyber' => ['name' => 'Cyber Tech', 'desc' => 'Modern Techie'],
                'pro-dark' => ['name' => 'Pro Dark', 'desc' => 'High Contrast'],
                'clean' => ['name' => 'Clean Air', 'desc' => 'Eco Friendly']
            ];

            $d = 1;
            foreach($index_templates as $key => $info): 
            ?>
            <div class="col animate__animated animate__zoomIn delay-<?php echo ($d < 4) ? $d : 3; ?>">
                <div class="index-template-card">
                    <div class="mini-cv-sheet style-<?php echo $key; ?>">
                        <div class="mini-content-box">
                            <div class="mini-name">Muhammad Bilal Ifzal</div>
                            <div class="mini-title">Senior Software Engineer</div>
                            <div class="mini-contact">Faisalabad, PK • +92 300 1234567 • bilal@example.com</div>
                            <hr class="mini-hr">
                            
                            <div class="mini-text-block">
                                <span class="mini-label">PROFESSIONAL SUMMARY</span>
                                Innovative developer with 8+ years of experience in architecting scalable web applications. Proven track record of leading high-performance teams and delivering user-centric solutions.
                            </div>

                            <div class="mini-text-block">
                                <span class="mini-label">WORK EXPERIENCE</span>
                                <b>Lead Developer | Innovate Tech</b> (2020-Present)<br>
                                • Scaled cloud infrastructure for 1M+ users.<br>
                                • Reduced system latency by 45% using Redis.<br>
                                <b>Full Stack Dev | Soft Solution</b> (2017-2020)<br>
                                • Developed 50+ custom enterprise modules.
                            </div>

                            <div class="mini-text-block">
                                <span class="mini-label">EDUCATION & PROJECTS</span>
                                <b>BS in Computer Science</b> - GC University<br>
                                <b>E-Commerce Engine:</b> Built a multi-vendor platform handling 10k transactions daily.
                            </div>

                            <div class="mini-text-block">
                                <span class="mini-label">TECHNICAL SKILLS</span>
                                <div class="d-flex flex-wrap gap-1 mt-1">
                                    <span class="mini-pill">PHP</span>
                                    <span class="mini-pill">Laravel</span>
                                    <span class="mini-pill">React</span>
                                    <span class="mini-pill">MySQL</span>
                                    <span class="mini-pill">AWS</span>
                                    <span class="mini-pill">Docker</span>
                                </div>
                            </div>
                            
                            <div class="mini-text-block">
                                <span class="mini-label">CERTIFICATIONS</span>
                                • AWS Solutions Architect Professional<br>
                                • Meta Front-End Developer Specialization
                            </div>
                        </div>
                        
                        <div class="mini-sheet-hover">
                            <a href="register.php" class="btn btn-sm btn-light fw-bold shadow-sm" style="font-size: 0.6rem;">Use This Design</a>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <h6 class="fw-bold mb-1"><?php echo $info['name']; ?></h6>
                        <small class="text-muted"><?php echo $info['desc']; ?></small>
                    </div>
                </div>
            </div>
            <?php $d++; endforeach; ?>
        </div>
    </div>
</section>

<section id="features" class="py-5" style="background-color: #f4f7f9;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">Why Choose Our Builder?</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 60px; height: 3px;"></div>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="feature-card">
                    <i class="fas fa-magic feature-icon"></i>
                    <h4 class="fw-bold">Easy to Use</h4>
                    <p class="text-muted">No design skills? No problem. Our intuitive interface guides you through every step.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp delay-1">
                <div class="feature-card">
                    <i class="fas fa-file-pdf feature-icon"></i>
                    <h4 class="fw-bold">Professional PDF</h4>
                    <p class="text-muted">Download your CV in clean, ATS-friendly PDF formats recognized by top employers.</p>
                </div>
            </div>
            <div class="col-md-4 animate__animated animate__fadeInUp delay-2">
                <div class="feature-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h4 class="fw-bold">Secure Data</h4>
                    <p class="text-muted">Your personal information is encrypted and safe with our secure hosting environment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">3 Simple Steps to Success</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="step-number">1</div>
                <h5 class="fw-bold">Register</h5>
                <p class="small text-muted px-4">Create your account in seconds to start building your profile.</p>
            </div>
            <div class="col-md-4">
                <div class="step-number">2</div>
                <h5 class="fw-bold">Fill Details</h5>
                <p class="small text-muted px-4">Enter your education, experience, and skills into your dashboard.</p>
            </div>
            <div class="col-md-4">
                <div class="step-number">3</div>
                <h5 class="fw-bold">Download</h5>
                <p class="small text-muted px-4">Preview your CV and download it instantly to start applying.</p>
            </div>
        </div>
    </div>
</section>

<section id="services" class="py-5 bg-light" style="border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase" style="letter-spacing: 2px;">What We Offer</h6>
            <h2 class="fw-bold mt-2" style="font-family: 'Playfair Display', serif; font-size: 2.5rem;">Professional CV Services</h2>
            <div class="mx-auto bg-primary mt-3" style="width: 60px; height: 3px;"></div>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px;">Boost your career prospects with our specialized tools designed by recruitment experts to get you noticed by top employers.</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="service-card p-4 h-100 shadow-sm border-0 rounded-4 bg-white">
                    <div class="service-icon-wrapper mb-4">
                        <i class="fas fa-magic fa-3x text-primary opacity-75"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Smart Builder</h4>
                    <p class="text-muted small">Our intuitive interface helps you create a professional resume in minutes without any design skills required.</p>
                    <ul class="list-unstyled text-start mt-3 small text-secondary">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Real-time preview</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Auto-save progress</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card p-4 h-100 shadow-sm border-0 rounded-4 bg-white">
                    <div class="service-icon-wrapper mb-4">
                        <i class="fas fa-search-dollar fa-3x text-primary opacity-75"></i>
                    </div>
                    <h4 class="fw-bold mb-3">ATS Optimization</h4>
                    <p class="text-muted small">Every template is engineered to pass through Applicant Tracking Systems (ATS) used by Fortune 500 companies.</p>
                    <ul class="list-unstyled text-start mt-3 small text-secondary">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Keyword friendly</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Standard PDF parsing</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card p-4 h-100 shadow-sm border-0 rounded-4 bg-white">
                    <div class="service-icon-wrapper mb-4">
                        <i class="fas fa-file-signature fa-3x text-primary opacity-75"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Cover Letters</h4>
                    <p class="text-muted small">Generate matching cover letters that perfectly align with your CV design for a consistent professional look.</p>
                    <ul class="list-unstyled text-start mt-3 small text-secondary">
                        <li><i class="fas fa-check-circle text-success me-2"></i> Matching themes</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> Customizable text</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative animate__animated animate__fadeInLeft">
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

                <div class="mt-5">
                    <a href="register.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Start Creating Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white text-center">
    <div class="container py-4">
        <h2 class="mb-4" style="font-family: 'Playfair Display', serif;">Ready to get hired?</h2>
        <a href="register.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold">Get Started for Free</a>
    </div>
</section>

<?php
include("footer.php");
?>