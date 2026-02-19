<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$user_id = $_SESSION['user_id'];
$edit_data = null; // Initially null

// --- HANDLE REMOVING RECORD ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM user_languages WHERE id = '$id' AND user_id = '$user_id'");
    header("Location: languages.php");
    exit();
}

// --- HANDLE FETCHING DATA FOR UPDATE ---
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_res = mysqli_query($conn, "SELECT * FROM user_languages WHERE id = '$edit_id' AND user_id = '$user_id'");
    $edit_data = mysqli_fetch_assoc($edit_res);
}

// --- HANDLE ADDING OR UPDATING LANGUAGE ---
if (isset($_POST['save_language'])) {
    $language = mysqli_real_escape_string($conn, $_POST['language_name']);
    $proficiency = mysqli_real_escape_string($conn, $_POST['proficiency']);

    if (isset($_POST['lang_id']) && !empty($_POST['lang_id'])) {
        // UPDATE EXISTING
        $id = $_POST['lang_id'];
        $sql = "UPDATE user_languages SET language_name='$language', proficiency='$proficiency' 
                WHERE id='$id' AND user_id='$user_id'";
    } else {
        // ADD NEW
        $sql = "INSERT INTO user_languages (user_id, language_name, proficiency) 
                VALUES ('$user_id', '$language', '$proficiency')";
    }
    
    if($conn->query($sql)) {
        header("Location: languages.php?status=success");
        exit();
    }
}

// Fetch all languages for this user
$lang_query = mysqli_query($conn, "SELECT * FROM user_languages WHERE user_id = '$user_id'");

// Fetch user name for display
$user_query = mysqli_query($conn, "SELECT full_name FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Languages | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .nav-link { color: #adb5bd; transition: 0.3s; margin-bottom: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; border-radius: 5px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-primary { background: #4e73df; border: none; border-radius: 8px; padding: 10px 20px; }

        /* MOBILE VIEW ONLY CHANGES */
        @media (max-width: 768px) {
            .p-5 { padding: 20px !important; }
            .sidebar { display: none !important; }
            
            /* Full length buttons on mobile */
            .mobile-full-btn {
                width: 100% !important;
                margin-bottom: 10px;
                margin-left: 0 !important;
            }
            
            /* Stack header elements */
            .header-flex {
                flex-direction: column;
            }
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
                <li class="nav-item"><a class="nav-link" href="skills.php"><i class="fas fa-code me-2"></i> Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php"><i class="fas fa-tasks me-2"></i> Projects</a></li>
                <li class="nav-item"><a class="nav-link active" href="languages.php"><i class="fas fa-language me-2"></i> Languages</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php"><i class="fas fa-certificate me-2"></i> Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="interests.php"><i class="fas fa-heart me-2"></i> Interests</a></li>
                <hr>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4 header-flex">
                <h2>Welcome, <?php echo $user['full_name']; ?> 👋</h2>
                <a href="preview.php" class="btn btn-outline-dark mobile-full-btn"><i class="fas fa-eye me-2"></i> Preview CV</a>
            </div>

            <div class="card p-4">
                <h5 class="fw-bold mb-4 text-primary">
                    <i class="fas fa-language me-2"></i>
                    <?php echo ($edit_data) ? 'Update Language' : 'Add Languages'; ?>
                </h5>
                
                <form method="POST" class="mb-5 border-bottom pb-4">
                    <input type="hidden" name="lang_id" value="<?php echo $edit_data['id'] ?? ''; ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Language</label>
                            <input type="text" name="language_name" class="form-control" placeholder="e.g. English, Urdu" value="<?php echo $edit_data['language_name'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Proficiency</label>
                            <select name="proficiency" class="form-select" required>
                                <option value="Native" <?php echo (isset($edit_data['proficiency']) && $edit_data['proficiency'] == 'Native') ? 'selected' : ''; ?>>Native</option>
                                <option value="Fluent" <?php echo (isset($edit_data['proficiency']) && $edit_data['proficiency'] == 'Fluent') ? 'selected' : ''; ?>>Fluent</option>
                                <option value="Intermediate" <?php echo (isset($edit_data['proficiency']) && $edit_data['proficiency'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="Basic" <?php echo (isset($edit_data['proficiency']) && $edit_data['proficiency'] == 'Basic') ? 'selected' : ''; ?>>Basic</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" name="save_language" class="btn btn-primary px-5 shadow-sm mobile-full-btn">
                            <?php echo ($edit_data) ? 'Update Language' : 'Add Language'; ?>
                        </button>
                        <a href="certificate.php" class="btn btn-dark px-5 shadow-sm ms-md-2 mobile-full-btn">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </form>

                <h5 class="fw-bold text-dark mt-4">Your Languages</h5>
                <div class="row mt-3 mb-5">
                    <?php if(mysqli_num_rows($lang_query) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($lang_query)): ?>
                        <div class="col-md-4 mb-3">
                            <div class="p-3 border rounded bg-white d-flex justify-content-between align-items-center shadow-sm">
                                <div>
                                    <h6 class="mb-1 fw-bold"><?php echo $row['language_name']; ?></h6>
                                    <span class="badge bg-light text-primary"><?php echo $row['proficiency']; ?></span>
                                </div>
                                <div class="text-end">
                                    <a href="languages.php?edit=<?php echo $row['id']; ?>" class="text-primary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="languages.php?delete=<?php echo $row['id']; ?>" class="text-danger" title="Remove" onclick="return confirm('Delete this language?')"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center text-muted py-3">No languages added yet.</div>
                    <?php endif; ?>
                </div>

                <div class="mt-4 border-top pt-4">
                    <h6 class="fw-bold text-muted mb-3 text-center text-md-start"><i class="fas fa-layer-group me-2"></i> Jump to Other Sections</h6>
                    <div class="row row-cols-2 row-cols-md-4 g-2">
                        <div class="col"><a href="dashboard.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-user d-block mb-1"></i> Personal</a></div>
                        <div class="col"><a href="education.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-graduation-cap d-block mb-1"></i> Education</a></div>
                        <div class="col"><a href="experience.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-briefcase d-block mb-1"></i> Experience</a></div>
                        <div class="col"><a href="skills.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-code d-block mb-1"></i> Skills</a></div>
                        <div class="col"><a href="projects.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-tasks d-block mb-1"></i> Projects</a></div>
                        <div class="col"><a href="certificate.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-certificate d-block mb-1"></i> Certificates</a></div>
                        <div class="col"><a href="interests.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-heart d-block mb-1"></i> Interests</a></div>
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