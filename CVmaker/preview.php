<?php
include 'config.php';
session_start();

// SECURITY: No one can access this URL without logging in first
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user_id'];

// MAINTENANCE LOGIC: Redirects user if Admin has clicked maintenance
$maintenance_res = @mysqli_query($conn, "SELECT maintenance_mode FROM users WHERE maintenance_mode = 1 LIMIT 1");
$is_maintenance = ($maintenance_res && mysqli_num_rows($maintenance_res) > 0);

if ($is_maintenance) {
    header("Location: maintenance.php");
    exit();
}

// Logic to handle print count
if (isset($_POST['update_print_count'])) {
    mysqli_query($conn, "UPDATE users SET cv_print_count = cv_print_count + 1 WHERE id = '$user_id'");
    echo "success";
    exit();
}

// Fetch user data
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'"));
$edu_result = mysqli_query($conn, "SELECT * FROM education WHERE user_id = '$user_id' ORDER BY start_date DESC");
$exp_result = mysqli_query($conn, "SELECT * FROM experience WHERE user_id = '$user_id' ORDER BY start_date DESC");
$skills_result = mysqli_query($conn, "SELECT * FROM skills WHERE user_id = '$user_id'");
$proj_result = mysqli_query($conn, "SELECT * FROM projects WHERE user_id = '$user_id'");

// Fetch result objects for Grid Layout
$lang_res_db = mysqli_query($conn, "SELECT language_name, proficiency FROM user_languages WHERE user_id = '$user_id'");
$cert_res_db = mysqli_query($conn, "SELECT certificate_name, organization FROM user_certificates WHERE user_id = '$user_id'");
$interest_res_db = mysqli_query($conn, "SELECT interest_name FROM user_interests WHERE user_id = '$user_id'");

$style = isset($_GET['style']) ? $_GET['style'] : 'modern';

include("header.php"); 
?>
<style>
    /* UI Background */
    .preview-bg { background: #dee2e6; padding-bottom: 40px; min-height: 100vh; }
    
    /* PREVIOUS FLEX ROW STYLE (Remains Unchanged) */
    .template-card { 
        cursor: pointer; 
        transition: 0.3s; 
        border: 3px solid transparent; 
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .template-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .template-card.active { border-color: #4e73df; background: #f8f9ff; }
    
    /* CV CONTAINER */
    .cv-outer-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 10px;
        overflow: hidden;
        height: 750px; 
    }

    .cv-paper { 
        background: white; 
        width: 210mm; 
        min-height: 297mm; 
        padding: 40px; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
        transform: scale(0.65); 
        transform-origin: top center;
        margin-top: 0;
    }

    /* --- MOBILE RESPONSIVENESS FIX --- */
    @media (max-width: 768px) {
        .cv-outer-container {
            height: auto; /* Let it grow on mobile */
            padding: 5px;
            overflow-x: auto; /* Prevent horizontal scroll breakage */
        }
        .cv-paper { 
            transform: scale(0.4); /* Shrink to fit mobile screens */
            transform-origin: top left;
            margin: 0 auto;
            width: 210mm; /* Keep A4 aspect ratio */
            box-shadow: none;
        }
        /* Make the container height match the scaled paper */
        .cv-outer-container {
            height: 500px; 
        }
    }
    /* ---------------------------------- */

    /* Template Typography & Layout Styles */
    .section-h { font-weight: bold; text-transform: uppercase; border-bottom: 2px solid #333; margin-top: 20px; margin-bottom: 12px; padding-bottom: 4px; font-size: 1rem; }
    
    .style-modern .section-h { color: #4e73df; border-color: #4e73df; }
    .style-executive { text-align: center; }
    .style-executive .section-h { background: #333; color: #fff; padding: 5px; }
    .style-minimal .sidebar-cv { background: #f8f9fa; border-right: 1px solid #ddd; padding: 20px; height: 100%; }
    .style-enthusiast .cv-head { background: #212529; color: white; margin: -40px -40px 30px -40px; padding: 40px; }
    
    .style-royal .section-h { color: #b8860b; border-color: #b8860b; border-bottom-width: 3px; }
    .style-cyber .section-h { color: #00d2d3; border-left: 10px solid #00d2d3; border-bottom: none; padding-left: 10px; }
    
    .style-pro-dark .cv-head { 
        background: #1e272e; 
        color: #00d2d3; 
        margin: -40px -40px 20px -40px; 
        padding: 45px; 
        border-bottom: 5px solid #00d2d3;
    }
    .style-pro-dark .section-h { 
        color: #00d2d3; 
        border-bottom: 2px solid #2f3640;
        background: rgba(0, 210, 211, 0.05);
        padding: 5px 10px;
    }

    .style-clean .section-h { border-bottom: 1px dashed #333; color: #27ae60; }

    .text-left { text-align: left; }
    .small-text { font-size: 0.85rem; line-height: 1.4; }

    /* PRINT LOGIC */
    @media print {
        body * { visibility: hidden; }
        .cv-outer-container, .cv-outer-container * { visibility: visible; }
        .cv-outer-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
        }
        .cv-paper { 
            transform: scale(1) !important; 
            box-shadow: none; 
            margin: 0 !important; 
            width: 100% !important; 
            border: none;
        }
        .no-print, header, footer, .navbar, .btn { display: none !important; }
        .preview-bg { background: white !important; }
    }
</style>

<div class="preview-bg">
    <div class="container no-print py-4">
        <h4 class="mb-4 fw-bold text-center">Select Your Template</h4>
        
        <div class="row row-cols-2 row-cols-md-4 g-3 px-lg-5 mb-4">
            <div class="col" onclick="location.href='?style=modern'">
                <div class="card h-100 template-card <?php echo $style == 'modern' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-file-invoice fa-2x mb-2 text-primary"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Modern</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=executive'">
                <div class="card h-100 template-card <?php echo $style == 'executive' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-user-tie fa-2x mb-2 text-dark"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Executive</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=minimal'">
                <div class="card h-100 template-card <?php echo $style == 'minimal' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-columns fa-2x mb-2 text-secondary"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Minimal</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=enthusiast'">
                <div class="card h-100 template-card <?php echo $style == 'enthusiast' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-magic fa-2x mb-2 text-warning"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Enthusiast</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-md-4 g-3 px-lg-5">
            <div class="col" onclick="location.href='?style=royal'">
                <div class="card h-100 template-card <?php echo $style == 'royal' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-crown fa-2x mb-2 text-info"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Royal</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=cyber'">
                <div class="card h-100 template-card <?php echo $style == 'cyber' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-microchip fa-2x mb-2 text-success"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Cyber</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=pro-dark'">
                <div class="card h-100 template-card <?php echo $style == 'pro-dark' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-briefcase fa-2x mb-2 text-danger"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Dark</h6>
                    </div>
                </div>
            </div>
            <div class="col" onclick="location.href='?style=clean'">
                <div class="card h-100 template-card <?php echo $style == 'clean' ? 'active' : ''; ?>">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-leaf fa-2x mb-2 text-success"></i>
                        <h6 class="fw-bold mb-0" style="font-size: 0.8rem;">Clean</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button onclick="incrementAndPrint()" class="btn btn-primary btn-lg shadow-sm px-4 rounded-pill">
                <i class="fas fa-file-pdf me-2"></i> Save / Print CV
            </button>
        </div>
    </div>

    <div class="cv-outer-container">
        <div class="cv-paper style-<?php echo $style; ?>">
            <div class="cv-head mb-4 <?php echo ($style == 'executive' || $style == 'royal' ? 'text-center' : ''); ?>">
                <h1 class="fw-bold mb-1"><?php echo $user['full_name']; ?></h1>
                <p class="text-muted small-text">
                    <?php echo $user['email']; ?> • <?php echo $user['phone']; ?> • <?php echo $user['address']; ?>
                </p>
            </div>

            <div class="row">
                <?php if($style == 'minimal'): ?>
                    <div class="col-4 sidebar-cv text-left">
                        <h5 class="section-h">Skills</h5>
                        <?php mysqli_data_seek($skills_result, 0); while($s = mysqli_fetch_assoc($skills_result)) echo "<div class='small-text mb-1'>• ".$s['skill_name']."</div>"; ?>
                        <h5 class="section-h">Education</h5>
                        <?php mysqli_data_seek($edu_result, 0); while($ed = mysqli_fetch_assoc($edu_result)) echo "<div class='small-text mb-2'><strong>".$ed['degree']."</strong><br>".$ed['institution']."</div>"; ?>
                    </div>
                    <div class="col-8 text-left">
                <?php else: ?>
                    <div class="col-12 <?php echo ($style == 'executive' || $style == 'royal' ? '' : 'text-left'); ?>">
                <?php endif; ?>

                        <h5 class="section-h">Professional Summary</h5>
                        <p class="small-text"><?php echo nl2br($user['summary']); ?></p>

                        <h5 class="section-h">Work Experience</h5>
                        <?php mysqli_data_seek($exp_result, 0); while($e = mysqli_fetch_assoc($exp_result)): ?>
                            <div class="mb-3 text-left">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-dark small-text"><?php echo $e['job_title']; ?></strong>
                                    <span class="small-text"><?php echo $e['start_date']; ?> - <?php echo $e['is_current'] ? 'Present' : $e['end_date']; ?></span>
                                </div>
                                <div class="text-primary small-text fw-bold"><?php echo $e['company_name']; ?></div>
                                <p class="small-text text-muted mt-1"><?php echo $e['job_description']; ?></p>
                            </div>
                        <?php endwhile; ?>

                        <h5 class="section-h">Projects</h5>
                        <?php mysqli_data_seek($proj_result, 0); while($p = mysqli_fetch_assoc($proj_result)): ?>
                            <div class="mb-2 text-left small-text">
                                <div class="fw-bold"><?php echo $p['project_title']; ?></div>
                                <p class="mb-0"><?php echo $p['project_description']; ?></p>
                            </div>
                        <?php endwhile; ?>

                        <?php if($style != 'minimal'): ?>
                            <h5 class="section-h">Education</h5>
                            <?php mysqli_data_seek($edu_result, 0); while($ed = mysqli_fetch_assoc($edu_result)): ?>
                                <div class="mb-2 text-left small-text">
                                    <strong><?php echo $ed['degree']; ?></strong> — <?php echo $ed['institution']; ?>
                                </div>
                            <?php endwhile; ?>

                            <h5 class="section-h">Skills</h5>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php mysqli_data_seek($skills_result, 0); while($s = mysqli_fetch_assoc($skills_result)): ?>
                                    <span class="badge border text-dark bg-light px-2 py-1 small-text"><?php echo $s['skill_name']; ?></span>
                                <?php endwhile; ?>
                            </div>

                            <?php if(mysqli_num_rows($lang_res_db) > 0): ?>
                                <h5 class="section-h">Languages</h5>
                                <div class="row">
                                    <?php while($l = mysqli_fetch_assoc($lang_res_db)): ?>
                                        <div class="col-4 mb-2">
                                            <div class="small-text">
                                                <strong><?php echo htmlspecialchars($l['language_name']); ?></strong>
                                                <div class="text-muted" style="font-size: 0.7rem;"><?php echo htmlspecialchars($l['proficiency']); ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                            <?php if(mysqli_num_rows($cert_res_db) > 0): ?>
                                <h5 class="section-h">Certificates & Awards</h5>
                                <div class="row">
                                    <?php while($c = mysqli_fetch_assoc($cert_res_db)): ?>
                                        <div class="col-6 mb-2">
                                            <div class="small-text">
                                                <strong><?php echo htmlspecialchars($c['certificate_name']); ?></strong>
                                                <div class="text-muted" style="font-size: 0.7rem;"><?php echo htmlspecialchars($c['organization']); ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                            <?php if(mysqli_num_rows($interest_res_db) > 0): ?>
                                <h5 class="section-h">Interests & Hobbies</h5>
                                <div class="row">
                                    <?php while($i = mysqli_fetch_assoc($interest_res_db)): ?>
                                        <div class="col-4 mb-2">
                                            <div class="small-text">
                                                <i class="fas fa-circle me-1" style="font-size: 0.3rem; vertical-align: middle;"></i> 
                                                <?php echo htmlspecialchars($i['interest_name']); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container no-print py-5" style="border-top: 2px solid #ccc; margin-top: 50px;">
    <h4 class="mb-5 fw-bold text-center text-dark">Premium Resume Library</h4>
    <div class="row row-cols-2 row-cols-md-4 g-4 px-lg-5">
        <?php 
        $all_styles = [
            'modern' => 'Modern Blue', 'executive' => 'Executive', 
            'minimal' => 'Minimalist', 'enthusiast' => 'Enthusiast',
            'royal' => 'Royal Gold', 'cyber' => 'Cyber Tech', 
            'pro-dark' => 'Pro Dark', 'clean' => 'Clean Air'
        ];
        foreach($all_styles as $s_key => $s_name): 
            mysqli_data_seek($edu_result, 0);
            mysqli_data_seek($exp_result, 0);
            mysqli_data_seek($skills_result, 0);
            mysqli_data_seek($proj_result, 0);
        ?>
        <div class="col" onclick="location.href='?style=<?php echo $s_key; ?>'">
            <div class="template-preview-card <?php echo $style == $s_key ? 'active-template' : ''; ?>">
                <div class="cv-mini-paper style-<?php echo $s_key; ?>">
                    <div class="mini-content-wrapper">
                        <div class="mini-header-text"><?php echo strtoupper($user['full_name']); ?></div>
                        <div class="mini-sub-text"><?php echo $user['email']; ?> | <?php echo $user['phone']; ?></div>
                        <div class="mini-divider"></div>
                        
                        <div class="mini-label">PROFILE</div>
                        <div style="font-size: 3px; max-height: 12px; overflow: hidden;"><?php echo $user['summary']; ?></div>

                        <div class="mini-label">EXPERIENCE</div>
                        <?php if($e = mysqli_fetch_assoc($exp_result)): ?>
                            <div style="font-size: 3px;"><b><?php echo $e['job_title']; ?></b> - <?php echo $e['company_name']; ?></div>
                        <?php endif; ?>

                        <div class="mini-label">SKILLS</div>
                        <div style="font-size: 3px;">
                            <?php $count=0; while($sk = mysqli_fetch_assoc($skills_result)): if($count++ > 3) break; ?>
                                <span class="mini-badge"><?php echo $sk['skill_name']; ?></span>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="mini-overlay">
                        <span class="badge bg-primary px-3 py-2 shadow-sm">Use Template</span>
                    </div>
                </div>
                <div class="template-label"><?php echo $s_name; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    /* CSS for Library Previews */
    .template-preview-card { cursor: pointer; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); text-align: center; position: relative; }
    .cv-mini-paper { background: white; aspect-ratio: 1 / 1.41; width: 100%; border-radius: 4px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 10px; overflow: hidden; margin-bottom: 12px; border: 1px solid #e0e0e0; position: relative; text-align: left; }
    .template-preview-card:hover .cv-mini-paper { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.12); border-color: #4e73df; }
    .active-template .cv-mini-paper { border: 2px solid #4e73df; box-shadow: 0 0 0 5px rgba(78, 115, 223, 0.1); }
    .mini-content-wrapper { font-size: 4px; line-height: 1.3; color: #444; }
    .mini-header-text { font-size: 7px; font-weight: 800; color: #111; margin-bottom: 1px; }
    .mini-sub-text { font-size: 4px; color: #777; margin-bottom: 4px; }
    .mini-label { font-size: 4.5px; color: #000; font-weight: bold; border-bottom: 0.5px solid #eee; display: block; margin-top: 3px; }
    .mini-divider { height: 1px; background: #eee; margin: 4px 0; }
    .mini-badge { display: inline-block; background: #f0f2f5; padding: 1px 3px; border-radius: 2px; margin-right: 2px; font-size: 3.5px; }

    .style-pro-dark.cv-mini-paper { background: #1e272e; border-color: #00d2d3; }
    .style-pro-dark .mini-header-text { color: #00d2d3; }
    .style-pro-dark .mini-sub-text { color: #bdc3c7; }
    .style-pro-dark .mini-content-wrapper { color: #ecf0f1; }
    .style-pro-dark .mini-label { color: #00d2d3; border-bottom-color: #2f3640; }
    .style-pro-dark .mini-badge { background: #2f3640; color: #00d2d3; }

    .style-modern .mini-header-text { color: #4e73df; }
    .style-executive .mini-label { background: #333; color: #fff; padding: 1px; text-decoration: none; }
    .style-royal { border-top: 3px solid #b8860b; }
    
    .mini-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    .template-preview-card:hover .mini-overlay { opacity: 1; }
    .template-label { font-weight: 700; color: #2d3436; font-size: 0.9rem; margin-top: 5px; }
</style>

<script>
function incrementAndPrint() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "preview.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.print();
        }
    };
    xhr.send("update_print_count=true");
}
</script>

<?php include("footer.php"); ?><style>
    /* UI Background */
    .preview-bg { background: #dee2e6; padding-bottom: 40px; min-height: 100vh; }
    
    /* PREVIOUS STYLE (Remains Unchanged) */
    .template-card { 
        cursor: pointer; 
        transition: 0.3s; 
        border: 3px solid transparent; 
        border-radius: 12px;
        background: #fff;
    }
    .template-card.active { border-color: #4e73df; background: #f8f9ff; }
    
    /* CV CONTAINER */
    .cv-outer-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        overflow: hidden; /* Important to hide the overflow of the scaled paper */
        height: 800px; 
    }

    .cv-paper { 
        background: white; 
        width: 210mm; 
        min-height: 297mm; 
        padding: 40px; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
        transform: scale(0.65); 
        transform-origin: top center;
    }

    /* --- THE FIX FOR 100% WIDTH ON MOBILE --- */
    @media (max-width: 768px) {
        .cv-outer-container {
            height: auto; 
            min-height: 550px;
            padding: 0; /* Remove padding so paper touches edges */
            display: block; /* Change from flex to block for easier centering */
            overflow-x: hidden;
        }

        .cv-paper { 
            /* This math forces the 210mm paper to shrink exactly to the phone's 100% width */
            transform: scale(calc(100vw / 210.5mm)); 
            
            /* Change origin to top left to align with the screen start */
            transform-origin: top left; 
            
            margin: 0 !important;
            width: 210mm; /* Keep hardcoded A4 width so content doesn't wrap */
            box-shadow: none; /* Shadow looks messy on 100% width mobile */
            border-radius: 0;
        }
    }
    /* ---------------------------------------- */

    /* All your other styles (section-h, templates, etc.) stay exactly as they are */
    .section-h { font-weight: bold; text-transform: uppercase; border-bottom: 2px solid #333; margin-top: 20px; margin-bottom: 12px; padding-bottom: 4px; font-size: 1rem; }
    .text-left { text-align: left; }
    .small-text { font-size: 0.85rem; line-height: 1.4; }

    /* PRINT LOGIC - MUST STAY AT SCALE 1 */
    @media print {
        body * { visibility: hidden; }
        .cv-outer-container, .cv-outer-container * { visibility: visible; }
        .cv-outer-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            display: block !important;
        }
        .cv-paper { 
            transform: scale(1) !important; 
            width: 210mm !important; 
            margin: 0 !important;
            padding: 40px !important;
        }
    }
</style>