<?php
session_start();
// Same logic to show Guest Header (Login/Register)
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

<style>
    .templates-hero {
        background: linear-gradient(45deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0;
        border-bottom: 1px solid #dee2e6;
    }
    
    /* Template Card Styling */
    .template-card-container {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        margin-bottom: 40px;
    }
    .template-card-container:hover {
        transform: translateY(-15px);
    }

    .cv-preview-frame {
        background: white;
        aspect-ratio: 1 / 1.41;
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 15px;
        position: relative;
        overflow: hidden;
        border: 1px solid #eee;
        text-align: left; /* Ensure content is aligned left within the frame */
    }

    /* Dummy Content Styling */
    .mini-text { font-size: 3.5px; color: #666; line-height: 1.4; margin-bottom: 3px; }
    .mini-name { font-size: 8px; font-weight: 800; color: #111; margin-bottom: 2px; text-transform: uppercase; }
    .mini-title { font-size: 4.5px; color: #0d6efd; font-weight: bold; margin-bottom: 6px; }
    .mini-section-h { font-size: 4px; font-weight: bold; border-bottom: 0.5px solid #ddd; margin-top: 5px; margin-bottom: 3px; color: #333; }
    .mini-sub { font-size: 3.5px; font-weight: bold; color: #222; }
    
    /* Theme Specific Frame Overlays */
    .style-modern { border-top: 6px solid #0d6efd; }
    .style-executive { text-align: center !important; }
    .style-executive .mini-section-h { border-bottom: none; background: #eee; padding: 1px 0; }
    .style-royal { border: 1.5px solid #b8860b; }
    .style-cyber { border-left: 6px solid #00d2d3; }
    .style-pro-dark { background: #2d3436; color: white; border: none; }
    .style-pro-dark .mini-name, .style-pro-dark .mini-sub, .style-pro-dark .mini-section-h { color: white; }
    .style-pro-dark .mini-text { color: #ccc; }
    .style-pro-dark .mini-section-h { border-bottom-color: #444; }

    .btn-use {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: 0.3s;
        z-index: 10;
    }
    .cv-preview-frame:hover .btn-use {
        opacity: 1;
    }
    .cv-preview-frame::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        opacity: 0;
        transition: 0.3s;
    }
    .cv-preview-frame:hover::after {
        opacity: 1;
    }

    .feature-box {
        padding: 30px;
        border-radius: 15px;
        background: #fff;
        transition: 0.3s;
    }
    .feature-box i {
        font-size: 2rem;
        color: #0d6efd;
        margin-bottom: 15px;
    }
</style>

<section class="templates-hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Top CV Templates</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Each template is hand-crafted by <b>Muhammad Bilal Ifzal</b> to ensure they meet the highest professional standards and pass Applicant Tracking Systems (ATS).
        </p>
    </div>
</section>
<style>
    /* Responsive Grid: Forces 2 columns on mobile devices */
    @media (max-width: 767px) {
        .row-cols-mobile-2 > * {
            flex: 0 0 50% !important;
            max-width: 50% !important;
            padding: 6px !important;
        }
        .template-card-container h5 { font-size: 0.8rem !important; }
        .cv-preview-frame { padding: 6px !important; }
    }

    .template-card-container {
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }
    .template-card-container:hover { transform: translateY(-10px); }

    .cv-preview-frame {
        background: white;
        aspect-ratio: 1 / 1.41;
        width: 100%;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden; /* Important to keep the "full" look clean */
        border: 1px solid #eee;
        padding: 8px;
        line-height: 1.15; 
    }

    /* Ultra-dense micro-text to fill every pixel of the frame */
    .mini-text { font-size: 2.2px; color: #444; margin-bottom: 0.8px; text-align: justify; letter-spacing: -0.05px; }
    .mini-name { font-size: 6px; font-weight: 800; color: #000; margin-bottom: 0.3px; text-transform: uppercase; }
    .mini-title { font-size: 3.5px; color: #0d6efd; font-weight: bold; margin-bottom: 1.5px; }
    .mini-section-h { font-size: 2.7px; font-weight: bold; border-bottom: 0.1px solid #999; margin-top: 3px; margin-bottom: 1.2px; padding-bottom: 0.3px; color: #000; text-transform: uppercase; }
    .mini-sub { font-size: 2.4px; font-weight: bold; color: #111; margin-bottom: 0.3px; }

    /* Layout Variations */
    .style-modern { border-top: 3px solid #0d6efd; }
    .style-executive { border-top: 3px solid #1a1a1a; text-align: center; }
    .style-royal { border: 0.5px solid #b8860b; background: #fffdf9; }
    .style-royal .mini-section-h { color: #b8860b; border-color: #b8860b; }
    .style-cyber { border-left: 3px solid #00d2d3; background: #fafafa; }
    .style-pro-dark { background: #1e272e; color: #fff; border: none; }
    .style-pro-dark .mini-text, .style-pro-dark .mini-name, .style-pro-dark .mini-section-h { color: #fff; border-color: #444; }
    .style-pro-dark .mini-sub { color: #00d2d3; }

    .btn-use {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0; transition: 0.3s; z-index: 10;
        font-size: 0.6rem; font-weight: bold; padding: 4px 8px;
    }
    .cv-preview-frame:hover .btn-use { opacity: 1; }
    .cv-preview-frame:hover::after {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
    }
</style>

<section class="py-5">
    <div class="container py-3">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 row-cols-mobile-2">
            <?php 
            $all_templates = [
                'modern' => 'Modern Professional',
                'executive' => 'Corporate Executive',
                'minimal' => 'Minimalist Sidebar',
                'enthusiast' => 'Creative Enthusiast',
                'royal' => 'Royal Elegant',
                'cyber' => 'Cyber Technology',
                'pro-dark' => 'Professional Dark',
                'clean' => 'Clean Aesthetic'
            ];

            foreach($all_templates as $key => $name): 
            ?>
            <div class="col">
                <div class="template-card-container text-center">
                    <div class="cv-preview-frame style-<?php echo $key; ?> text-start">
                        
                        <?php if($key == 'minimal' || $key == 'clean'): ?>
                            <div class="d-flex h-100" style="gap: 3px;">
                                <div style="width: 38%; background: #f8f9fa; padding: 3px; height: 100%; border-right: 0.1px solid #ddd;">
                                    <div style="width: 12px; height: 12px; background: #ddd; border-radius: 50%; margin: 0 auto 3px;"></div>
                                    <div class="mini-section-h">CONTACT</div>
                                    <div class="mini-text">📍 Faisalabad, PK</div>
                                    <div class="mini-text">📞 0300-1234567</div>
                                    <div class="mini-text">📧 bilal@cv.com</div>
                                    <div class="mini-text">🔗 linkedin/bilal</div>
                                    <div class="mini-section-h">HARD SKILLS</div>
                                    <div class="mini-text">• PHP / Laravel / OOP</div>
                                    <div class="mini-text">• MySQL / Redis / AWS</div>
                                    <div class="mini-text">• React / Next.js / TS</div>
                                    <div class="mini-text">• Docker / K8s / Git</div>
                                    <div class="mini-section-h">SOFT SKILLS</div>
                                    <div class="mini-text">• Team Leadership</div>
                                    <div class="mini-text">• Critical Thinking</div>
                                    <div class="mini-section-h">LANGUAGES</div>
                                    <div class="mini-text">English (Fluent)</div>
                                    <div class="mini-text">Urdu (Native)</div>
                                    <div class="mini-text">Arabic (Basic)</div>
                                    <div class="mini-section-h">CERTIFICATES</div>
                                    <div class="mini-text">Google UX Design</div>
                                    <div class="mini-text">AWS Solutions Architect</div>
                                    <div class="mini-section-h">INTERESTS</div>
                                    <div class="mini-text">Open Source, AI, IoT</div>
                                </div>
                                <div style="width: 62%; padding: 1px;">
                                    <div class="mini-name">M. Bilal Ifzal</div>
                                    <div class="mini-title">Full Stack Architect</div>
                                    <div class="mini-section-h">PROFESSIONAL BIO</div>
                                    <div class="mini-text">Versatile engineer with 7 years of building scalable cloud applications. Expert in modern web standards.</div>
                                    <div class="mini-section-h">WORK HISTORY</div>
                                    <div class="mini-sub">Senior Dev @ TechX</div>
                                    <div class="mini-text">2021-Present | Full-time</div>
                                    <div class="mini-text">• Architected 12 microservices.</div>
                                    <div class="mini-text">• Reduced server costs by 30%.</div>
                                    <div class="mini-sub">Software Eng @ Global</div>
                                    <div class="mini-text">2018-2021 | Senior Role</div>
                                    <div class="mini-text">• Managed 5 core web portals.</div>
                                    <div class="mini-section-h">KEY PROJECTS</div>
                                    <div class="mini-text"><b>ERP Max:</b> Enterprise system.</div>
                                    <div class="mini-text"><b>E-Com:</b> High-scale shop.</div>
                                    <div class="mini-section-h">EDUCATION</div>
                                    <div class="mini-text">BS Computer Science - UET</div>
                                    <div class="mini-text">F.Sc Pre-Eng - PGC</div>
                                    <div class="mini-section-h">VOLUNTEER</div>
                                    <div class="mini-text">Mentor @ CodeCamp 2022</div>
                                    <div class="mini-section-h">REFERENCES</div>
                                    <div class="mini-text">Available on formal request.</div>
                                </div>
                            </div>

                        <?php elseif($key == 'executive' || $key == 'royal'): ?>
                            <div class="text-center">
                                <div class="mini-name">MUHAMMAD BILAL IFZAL</div>
                                <div class="mini-title" style="color: #444; border-bottom: 0.1px solid #444; display: inline-block; padding: 0 6px 1px;">Chief Technology Officer</div>
                                <div class="mini-text" style="margin: 2px 0;">Pakistan • +92 300 1234567 • bilal@cvmaker.com • Portfolio: bilal.pro</div>
                                
                                <div class="mini-section-h">EXECUTIVE SUMMARY</div>
                                <div class="mini-text">Visionary Technology Leader with 10+ years of driving innovation in fintech and e-commerce. Expert in digital transformation, cloud infrastructure, and building elite engineering cultures. Proven record in scaling startups to multi-million user platforms.</div>
                                
                                <div class="mini-section-h">PROFESSIONAL WORK HISTORY</div>
                                <div class="mini-sub">Innovate Systems | CTO | 2019 – 2024</div>
                                <div class="mini-text">• Architected enterprise-grade SaaS platforms for 2M+ active users globally.</div>
                                <div class="mini-text">• Managed engineering budget of $500k and reduced debt by 40%.</div>
                                <div class="mini-text">• Implemented advanced AI-driven analytics for real-time data processing.</div>
                                <div class="mini-sub">Global Tech | Senior Software Architect | 2015 – 2019</div>
                                <div class="mini-text">• Directed the migration of 100+ legacy services to AWS Lambda.</div>
                                <div class="mini-text">• Redesigned security protocols reducing data breaches to zero.</div>

                                <div class="mini-section-h">CORE COMPETENCIES & EXPERTISE</div>
                                <div class="mini-text">Cloud Architecture (AWS/Azure) • Agile Scrum Mastery • Cybersecurity Compliance • Machine Learning • CI/CD Pipelines • React/Node/Python Stack • Strategic Planning</div>

                                <div class="mini-section-h">ACADEMIC & RESEARCH BACKGROUND</div>
                                <div class="mini-text">MS Software Engineering - NUST (Gold Medalist) | BSCS - Punjab University</div>
                                <div class="mini-text">Research: "Optimizing High-Traffic PHP Apps" - Published 2023</div>

                                <div class="mini-section-h">AWARDS & ACHIEVEMENTS</div>
                                <div class="mini-text">Best CTO 2023 (TechAwards) • 50+ Successful Enterprise Launches</div>

                                <div class="mini-section-h">CORE VALUES</div>
                                <div class="mini-text">Integrity • Innovation • Scalability • Mentorship • Efficiency</div>
                            </div>

                        <?php else: ?>
                            <div class="d-flex justify-content-between align-items-end" style="border-bottom: 0.3px solid #eee; padding-bottom: 1px;">
                                <div>
                                    <div class="mini-name">M. Bilal Ifzal</div>
                                    <div class="mini-title" style="margin-bottom: 0;">Lead Full Stack Engineer</div>
                                </div>
                                <div class="mini-text" style="text-align: right;">0300-1234567<br>bilal@cv.pk<br>Faisalabad, PK</div>
                            </div>

                            <div class="mini-section-h">PROFESSIONAL PROFILE</div>
                            <div class="mini-text">Passionate developer with expert-level proficiency in Laravel and React. Dedicated to writing clean, maintainable code and solving complex architectural problems.</div>
                            
                            <div class="mini-section-h">WORK EXPERIENCE</div>
                            <div class="mini-sub">Lead Developer | DevSquare | 2021 – Present</div>
                            <div class="mini-text">• Engineered a high-performance CMS for national news websites.</div>
                            <div class="mini-text">• Optimized SQL schemas, improving data retrieval by 55%.</div>
                            <div class="mini-text">• Led a team of 8 junior developers through major product cycles.</div>
                            <div class="mini-sub">Full Stack Developer | WebXen | 2018 – 2020</div>
                            <div class="mini-text">• Built 40+ responsive web apps using Vue.js and Node.js.</div>
                            <div class="mini-text">• Automated testing workflows using Jest and PHPUnit.</div>

                            <div class="mini-section-h">TECHNICAL TOOLKIT</div>
                            <div class="mini-text"><b>Back:</b> PHP 8.3, Laravel, Node, Python, Redis, Postgres, Docker</div>
                            <div class="mini-text"><b>Front:</b> React, Vue 3, TypeScript, Tailwind, Next.js, Redux</div>
                            <div class="mini-text"><b>Cloud:</b> AWS (S3, EC2), DigitalOcean, Vercel, Jenkins</div>

                            <div class="mini-section-h">PROJECT PORTFOLIO</div>
                            <div class="mini-text"><b>HealthLink:</b> Real-time patient monitoring system with HL7.</div>
                            <div class="mini-text"><b>CryptoFlow:</b> Decentralized exchange dashboard for tokens.</div>

                            <div class="mini-section-h">CERTIFICATIONS</div>
                            <div class="mini-text">AWS Solutions Architect Professional • Meta Front-End Spec</div>

                            <div class="mini-section-h">EDUCATION</div>
                            <div class="mini-text">BS Computer Science - University of Information Tech</div>
                            
                            
                            <div class="mini-section-h">EXTRAS</div>
                            <div class="mini-text">Active open-source contributor (15+ packages). Tech Blogger.</div>
                        <?php endif; ?>

                        <a href="register.php" class="btn btn-primary btn-sm btn-use shadow">Use Template</a>
                    </div>
                    <h5 class="fw-bold mt-3 mb-1"><?php echo $name; ?></h5>
                    <div class="text-warning mb-1" style="font-size: 0.6rem;">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="small text-muted mb-0">Premium Full Layout</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;">Why Our Templates?</h2>
            <div class="mx-auto bg-primary mt-2" style="width: 50px; height: 3px;"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box text-center shadow-sm">
                    <i class="fas fa-check-double"></i>
                    <h5>ATS-Friendly</h5>
                    <p class="text-muted small">Designed with a clean structure that recruitment robots (ATS) can easily read and rank.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center shadow-sm">
                    <i class="fas fa-file-pdf"></i>
                    <h5>One-Click Export</h5>
                    <p class="text-muted small">Download your finalized CV in high-quality PDF format, ready to be sent to employers.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box text-center shadow-sm">
                    <i class="fas fa-user-graduate"></i>
                    <h5>Built for Students</h5>
                    <p class="text-muted small">Created by Muhammad Bilal Ifzal specifically to help students get their first job for free.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-primary text-white text-center">
    <div class="container py-4">
        <h2 class="fw-bold mb-3">Ready to build your professional CV?</h2>
        <p class="mb-4 opacity-75">Join thousands of students who have already landed jobs using BilalCvMaker.</p>
        <a href="register.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-primary shadow">Create My CV Now - It's Free</a>
    </div>
</section>

<?php include("footer.php"); ?>