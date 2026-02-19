<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$user_id = $_SESSION['user_id'];
$edit_data = null;

// --- HANDLE REMOVING RECORD ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM skills WHERE id = '$id' AND user_id = '$user_id'");
    header("Location: skills.php");
    exit();
}

// --- HANDLE FETCHING DATA FOR UPDATE ---
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_res = mysqli_query($conn, "SELECT * FROM skills WHERE id = '$edit_id' AND user_id = '$user_id'");
    $edit_data = mysqli_fetch_assoc($edit_res);
}

// --- HANDLE ADDING OR UPDATING SKILL ---
if (isset($_POST['save_skill'])) {
    $skill_name = mysqli_real_escape_string($conn, $_POST['skill_name']);
    $proficiency = mysqli_real_escape_string($conn, $_POST['proficiency_level']);

    if (isset($_POST['skill_id']) && !empty($_POST['skill_id'])) {
        // UPDATE EXISTING RECORD
        $id = $_POST['skill_id'];
        $sql = "UPDATE skills SET skill_name='$skill_name', proficiency_level='$proficiency' 
                WHERE id='$id' AND user_id='$user_id'";
    } else {
        // ADD NEW RECORD
        $sql = "INSERT INTO skills (user_id, skill_name, proficiency_level) 
                VALUES ('$user_id', '$skill_name', '$proficiency')";
    }
    
    if($conn->query($sql)) {
        header("Location: skills.php?status=success");
        exit();
    }
}

// Fetch all skills for the current user
$skills_query = mysqli_query($conn, "SELECT * FROM skills WHERE user_id = '$user_id'");

// Fetch user data for the greeting
$user_query = mysqli_query($conn, "SELECT full_name FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .nav-link { color: #adb5bd; transition: 0.3s; margin-bottom: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; border-radius: 5px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-primary { background: #4e73df; border: none; border-radius: 8px; padding: 10px 20px; }

        /* --- MOBILE RESPONSIVENESS (Exact Dashboard Match) --- */
        @media (max-width: 768px) {
            .p-5 { padding: 20px !important; }
            .sidebar { display: none !important; }
            .col-md-5, .col-md-4, .col-md-3, .col-md-12 { width: 100% !important; }
            .text-end { text-align: center !important; }
            .btn { width: 100% !important; margin: 5px 0 !important; }
            /* Hide the footer mt-4 section on mobile as requested */
            .footer .mt-4 { display: none !important; }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
            <h4 class="text-center mb-4">CV Builder</h4>
            <ul class="nav flex-column px-3">
                <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-user me-2"></i> Personal</a></li>
                <li class="nav-item"><a class="nav-link" href="education.php"><i class="fas fa-graduation-cap me-2"></i> Education</a></li>
                <li class="nav-item"><a class="nav-link" href="experience.php"><i class="fas fa-briefcase me-2"></i> Experience</a></li>
                <li class="nav-item"><a class="nav-link active" href="skills.php"><i class="fas fa-code me-2"></i> Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php"><i class="fas fa-tasks me-2"></i> Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="languages.php"><i class="fas fa-language me-2"></i> Languages</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php"><i class="fas fa-certificate me-2"></i> Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="interests.php"><i class="fas fa-heart me-2"></i> Interests</a></li>
                <hr>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2>Welcome, <?php echo $user['full_name']; ?> 👋</h2>
                <a href="preview.php" class="btn btn-outline-dark mb-2"><i class="fas fa-eye me-2"></i> Preview CV</a>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-4 text-primary">
                    <i class="fas fa-lightbulb me-2"></i>
                    <?php echo ($edit_data) ? 'Update Skill' : 'Add Your Skills'; ?>
                </h5>
                
                <form method="POST" class="mb-5 border-bottom pb-4">
                    <input type="hidden" name="skill_id" value="<?php echo $edit_data['id'] ?? ''; ?>">
                    
                    <div class="row align-items-end">
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Skill Name</label>
                            <input type="text" name="skill_name" class="form-control" placeholder="e.g. PHP, Graphic Design" value="<?php echo $edit_data['skill_name'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Proficiency Level</label>
                            <select name="proficiency_level" class="form-select" required>
                                <option value="Beginner" <?php echo (isset($edit_data['proficiency_level']) && $edit_data['proficiency_level'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                                <option value="Intermediate" <?php echo (isset($edit_data['proficiency_level']) && $edit_data['proficiency_level'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="Advanced" <?php echo (isset($edit_data['proficiency_level']) && $edit_data['proficiency_level'] == 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
                                <option value="Expert" <?php echo (isset($edit_data['proficiency_level']) && $edit_data['proficiency_level'] == 'Expert') ? 'selected' : ''; ?>>Expert</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3 d-flex">
                            <button type="submit" name="save_skill" class="btn btn-primary w-100 shadow-sm">
                                <i class="fas fa-save me-2"></i>
                                <?php echo ($edit_data) ? 'Update' : 'Add Skill'; ?>
                            </button>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="projects.php" class="btn btn-dark px-5 shadow-sm">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </form>

                <h5 class="fw-bold text-dark mt-4 text-center text-md-start">Your Skillset</h5>
                <div class="row mt-3">
                    <?php if(mysqli_num_rows($skills_query) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($skills_query)): ?>
                        <div class="col-md-4 mb-3">
                            <div class="p-3 border rounded bg-white d-flex justify-content-between align-items-center shadow-sm">
                                <div>
                                    <h6 class="mb-1 fw-bold"><?php echo $row['skill_name']; ?></h6>
                                    <span class="badge bg-light text-primary"><?php echo $row['proficiency_level']; ?></span>
                                </div>
                                <div class="text-end">
                                    <a href="skills.php?edit=<?php echo $row['id']; ?>" class="text-primary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="skills.php?delete=<?php echo $row['id']; ?>" class="text-danger" title="Remove" onclick="return confirm('Delete this skill?')"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center text-muted py-3">No skills added yet.</div>
                    <?php endif; ?>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold text-muted mb-3 text-center text-md-start"><i class="fas fa-layer-group me-2"></i> Jump to Other Sections</h6>
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <a href="dashboard.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-user d-block mb-1"></i> Personal</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="education.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-graduation-cap d-block mb-1"></i> Education</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="experience.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-briefcase d-block mb-1"></i> Experience</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="projects.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-tasks d-block mb-1"></i> Projects</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="languages.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-language d-block mb-1"></i> Languages</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="certificate.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-certificate d-block mb-1"></i> Certificates</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="interests.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-heart d-block mb-1"></i> Interests</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include("footer.php"); ?>