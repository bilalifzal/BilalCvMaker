<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];

// --- FETCHING DATA FOR SUMMARY ---
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

$exp_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM experience WHERE user_id = '$user_id'"));
$edu_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM education WHERE user_id = '$user_id'"));
$skill_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM skills WHERE user_id = '$user_id'"));

$job_query = mysqli_query($conn, "SELECT job_title FROM experience WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
$job = mysqli_fetch_assoc($job_query);

include("header.php"); 
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { background-color: #f8f9fc; font-family: 'Segoe UI', Tahoma, sans-serif; }
    
    /* CLASSIC BLUE HEADER */
    .account-header { 
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); 
        color: white; 
        padding: 80px 0 100px; 
        border-radius: 0 0 50px 50px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* BEAUTIFUL MARQUEE DIV BELOW NAME */
    .marquee-wrapper {
        background: #ffffff;
        color: #4e73df;
        padding: 12px 0;
        margin-top: -30px;
        margin-bottom: 30px;
        border-radius: 50px;
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        border-bottom: 3px solid #4e73df;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .acc-card { border: none; border-radius: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.08); background: #fff; }
    
    /* OVERLAPPING PROFILE CIRCLE */
    .profile-img-circle { 
        width: 130px; height: 130px; background: #fff; color: #4e73df; 
        display: flex; align-items: center; justify-content: center; font-size: 3.5rem; 
        font-weight: bold; border-radius: 50%; margin: -65px auto 15px; 
        border: 8px solid #f8f9fc; box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
    }

    /* CV MINIATURE PREVIEW */
    .cv-thumb {
        background: #f8f9fc; border: 1px dashed #4e73df; border-radius: 15px;
        padding: 20px; text-align: center; transition: 0.3s;
    }
    .cv-thumb:hover { background: #eef2ff; border-style: solid; }

    /* ACTION OPTIONS GRID */
    .option-box {
        background: #fff; border: 1px solid #eaecf4; border-radius: 20px;
        padding: 25px 15px; text-align: center; color: #4e73df;
        transition: 0.4s all cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        text-decoration: none; display: block; height: 100%;
    }
    .option-box:hover { 
        background: #4e73df; color: #fff; transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(78,115,223,0.25);
    }
    .option-box i { font-size: 2.2rem; margin-bottom: 15px; display: block; }
    .option-box span { font-weight: 700; font-size: 0.95rem; }

    .btn-action-group { display: flex; gap: 10px; flex-wrap: wrap; }
</style>

<div class="account-header text-center">
    <div class="container animate__animated animate__fadeIn">
        <h1 class="fw-bold display-4 mb-1">Welcome To <?php echo $user['full_name']; ?> Account</h1>
        <p class="lead opacity-75 fs-5">Member ID: #00io902<?php echo $user['id']; ?></p>
    </div>
</div>

<div class="marquee-wrapper animate__animated animate__fadeInUp">
    <marquee behavior="scroll" direction="left" scrollamount="8">
         <span class="mx-3"><b>FREE POLICY:</b> 1 User & 1 Email can generate 1 professional CV only for free!</span> | 
         <span class="mx-3"><b>PRO VERSION V2.0:</b> Launching soon with Multiple CV Management and 20+ Premium Templates!</span>
    </marquee>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card acc-card p-4 text-center animate__animated animate__fadeInLeft">
                <div class="profile-img-circle">
                    <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                </div>
                <h3 class="fw-bold text-dark mt-2"><?php echo $user['full_name']; ?></h3>
                <p class="text-muted small mb-4">Official Platform Member</p>
                
                <div class="row border-top border-bottom py-3 mb-4">
                    <div class="col-4"><h5><?php echo $edu_count; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">Edu</small></div>
                    <div class="col-4"><h5><?php echo $exp_count; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">Work</small></div>
                    <div class="col-4"><h5><?php echo $skill_count; ?></h5><small class="text-muted text-uppercase" style="font-size: 10px;">Skills</small></div>
                </div>

                <div class="list-group list-group-flush text-start">
                    <a href="dashboard.php" class="list-group-item list-group-item-action border-0 py-3"><i class="fas fa-cog me-2 text-primary"></i> Account Settings</a>
                    <a href="logout.php" class="list-group-item list-group-item-action border-0 py-3 text-danger"><i class="fas fa-power-off me-2"></i> Logout Session</a>
                </div>
                <div class="alert alert-warning small text-start border-0" style="background: #fff9e6;">
                    <i class="fas fa-crown me-2"></i> <b>Pro Version</b>
                    <p class="mb-0 mt-1 opacity-75">Upgrade soon to unlock <b>Multiple CV</b> storage and premium file management.</p>
                </div>
                <div class="alert alert-success small text-start border-0" style="background: #17aecc2f;">
                    <i class="fas fa-user me-2"></i> <b>1 user Policy</b>
                    <p class="mb-0 mt-1 opacity-75">1 User can generate  <b>1 Free CV</b> you can further update your records.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card acc-card p-4 mb-4 animate__animated animate__fadeInRight">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-primary m-0"><i class="fas fa-file-invoice me-2"></i>Your Active CV</h5>
                    <span class="badge bg-light text-primary border px-3">1 User : 1 CV Policy</span>
                </div>
                
                <div class="row g-4 align-items-center">
                    <div class="col-md-4">
                        <div class="cv-thumb">
                            <i class="fas fa-file-pdf fa-4x text-primary opacity-25 mb-2"></i>
                            <p class="small fw-bold text-primary mb-0">Main Resume</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-1 text-dark"><?php echo $job ? $job['job_title'] : 'Resume Data Incomplete'; ?></h4>
                        <p class="text-muted small">Your professional data is stored securely. One CV limit ensures high performance for all free users.</p>
                        
                        <div class="btn-action-group mt-3">
                            <a href="preview.php" class="btn btn-dark rounded-pill px-4 shadow-sm btn-sm"><i class="fas fa-download me-2"></i>Download</a>
                            <a href="preview.php" class="btn btn-primary rounded-pill px-4 shadow-sm btn-sm"><i class="fas fa-eye me-2"></i>Preview</a>
                            <a href="dashboard.php" class="btn btn-outline-primary rounded-pill px-4 shadow-sm btn-sm"><i class="fas fa-edit me-2"></i>Update Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold text-dark mb-4"><i class="fas fa-th-large me-2 text-primary"></i>Manage Sections</h5>
            <div class="row g-3 animate__animated animate__fadeInUp">
                <div class="col-6 col-md-3"><a href="dashboard.php" class="option-box"><i class="fas fa-user-circle"></i><span>Personal</span></a></div>
                <div class="col-6 col-md-3"><a href="education.php" class="option-box"><i class="fas fa-graduation-cap"></i><span>Education</span></a></div>
                <div class="col-6 col-md-3"><a href="experience.php" class="option-box"><i class="fas fa-briefcase"></i><span>Experience</span></a></div>
                <div class="col-6 col-md-3"><a href="skills.php" class="option-box"><i class="fas fa-tools"></i><span>Skills</span></a></div>
                <div class="col-6 col-md-3"><a href="projects.php" class="option-box"><i class="fas fa-laptop-code"></i><span>Projects</span></a></div>
                <div class="col-6 col-md-3"><a href="languages.php" class="option-box"><i class="fas fa-language"></i><span>Languages</span></a></div>
                <div class="col-6 col-md-3"><a href="certificate.php" class="option-box"><i class="fas fa-medal"></i><span>Certificates</span></a></div>
                <div class="col-6 col-md-3"><a href="interests.php" class="option-box"><i class="fas fa-heart"></i><span>Interests</span></a></div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>