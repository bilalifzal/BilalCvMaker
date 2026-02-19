<?php
session_start();
// Database Connection - Replace with your actual credentials
include("config.php");

$success_msg = "";
$error_msg = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        $success_msg = "Thank you! Your message has been sent successfully. Muhammad Bilal Ifzal will get back to you soon.";
    } else {
        $error_msg = "Error: Could not save your message. Please try again.";
    }
}

include("header.php");
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="classic-marquee">
    <div class="marquee-content">
        🚀 HAVE QUESTIONS? CONTACT US NOW • TOTALLY DEVELOPED BY MUHAMMAD BILAL IFZAL • 1 USER FOR 1 CV POLICY • NEW UPDATE VERSION COMING SOON! • 🚀 HAVE QUESTIONS? CONTACT US NOW
    </div>
</div>

<style>
    .classic-marquee {
        width: 100%;
        background: #000;
        color: #fff;
        padding: 12px 0;
        overflow: hidden;
        white-space: nowrap;
        font-weight: bold;
        border-bottom: 2px solid #0d6efd;
    }
    .marquee-content {
        display: inline-block;
        padding-left: 100%;
        animation: marquee-scroll 25s linear infinite;
    }
    @keyframes marquee-scroll {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-100%, 0); }
    }

    .contact-hero {
        background: linear-gradient(45deg, #0d6efd 0%, #003d99 100%);
        padding: 80px 0;
        color: white;
        width: 100%;
    }

    .contact-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .info-box {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        border-left: 5px solid #0d6efd;
        height: 100%;
        transition: 0.3s;
    }
    .info-box:hover { transform: translateY(-5px); }
    .info-box i { font-size: 2rem; color: #0d6efd; margin-bottom: 15px; }
</style>

<section class="contact-hero text-center w-100">
    <div class="container" data-aos="fade-down">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Get In Touch</h1>
        <p class="lead opacity-75 mx-auto" style="max-width: 700px;">
            Have questions about **BilalCvMaker**? Our developer, **Muhammad Bilal Ifzal**, is here to help you.
        </p>
    </div>
</section>

<section class="py-5 w-100">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12" data-aos="fade-right" data-aos-delay="100">
                        <div class="info-box">
                            <i class="fas fa-envelope-open-text"></i>
                            <h5>Email Us</h5>
                            <p class="text-muted small">support@bilalcvmaker.com</p>
                        </div>
                    </div>
                    <div class="col-12" data-aos="fade-right" data-aos-delay="200">
                        <div class="info-box">
                            <i class="fas fa-user-check"></i>
                            <h5>Developer Direct</h5>
                            <p class="text-muted small">Muhammad Bilal Ifzal</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
                <div class="contact-card p-4 p-md-5">
                    
                    <?php if($success_msg): ?>
                        <div class="alert alert-success border-0 shadow-sm animate__animated animate__fadeInDown" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <?php echo $success_msg; ?>
                        </div>
                    <?php endif; ?>

                    <?php if($error_msg): ?>
                        <div class="alert alert-danger border-0 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error_msg; ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="fw-bold mb-4">Send a Message</h3>
                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="What is this about?" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Message</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Your message..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" name="submit_contact" class="btn btn-primary btn-lg px-5 rounded-pill shadow w-100">
                                    Send Message <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: false });</script>