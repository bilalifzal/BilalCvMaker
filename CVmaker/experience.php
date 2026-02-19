<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$user_id = $_SESSION['user_id'];
$edit_data = null;

// --- HANDLE REMOVING RECORD ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM experience WHERE id = '$id' AND user_id = '$user_id'");
    header("Location: experience.php");
    exit();
}

// --- HANDLE FETCHING DATA FOR UPDATE ---
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_res = mysqli_query($conn, "SELECT * FROM experience WHERE id = '$edit_id' AND user_id = '$user_id'");
    $edit_data = mysqli_fetch_assoc($edit_res);
}

// --- HANDLE ADDING OR UPDATING EXPERIENCE ---
if (isset($_POST['save_exp'])) {
    $company = mysqli_real_escape_string($conn, $_POST['company_name']);
    $title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $current = isset($_POST['is_current']) ? 1 : 0;
    $desc = mysqli_real_escape_string($conn, $_POST['job_description']);

    if (isset($_POST['exp_id']) && !empty($_POST['exp_id'])) {
        // UPDATE EXISTING RECORD
        $id = $_POST['exp_id'];
        $sql = "UPDATE experience SET company_name='$company', job_title='$title', location='$location', 
                start_date='$start', end_date='$end', is_current='$current', job_description='$desc' 
                WHERE id='$id' AND user_id='$user_id'";
    } else {
        // ADD NEW RECORD
        $sql = "INSERT INTO experience (user_id, company_name, job_title, location, start_date, end_date, is_current, job_description) 
                VALUES ('$user_id', '$company', '$title', '$location', '$start', '$end', '$current', '$desc')";
    }
    
    if($conn->query($sql)) {
        header("Location: experience.php?status=success");
        exit();
    }
}

// Fetch all experience for the table
$exp_query = mysqli_query($conn, "SELECT * FROM experience WHERE user_id = '$user_id' ORDER BY start_date DESC");

// Fetch user data for greeting
$user_query = mysqli_query($conn, "SELECT full_name FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Experience | BilalCvMaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* MATCHING EDUCATION.PHP STYLES */
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .nav-link { color: #adb5bd; transition: 0.3s; margin-bottom: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; border-radius: 5px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-primary { background: #4e73df; border: none; border-radius: 8px; padding: 10px 20px; }

        /* --- MOBILE RESPONSIVENESS (MATCHING EDUCATION.PHP) --- */
        @media (max-width: 768px) {
            .p-5 { padding: 20px !important; }
            .sidebar { display: none !important; }
            .col-md-6, .col-md-4, .col-md-12 { width: 100% !important; }
            .text-end { text-align: center !important; }
            .btn { width: 100% !important; margin: 5px 0 !important; }
            .table-responsive { border: 0; }
            .footer .mt-4{ display:none; }
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
                <li class="nav-item"><a class="nav-link active" href="experience.php"><i class="fas fa-briefcase me-2"></i> Experience</a></li>
                <li class="nav-item"><a class="nav-link" href="skills.php"><i class="fas fa-code me-2"></i> Skills</a></li>
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
                    <i class="fas fa-briefcase me-2"></i>
                    <?php echo ($edit_data) ? 'Update Professional Experience' : 'Add Professional Experience'; ?>
                </h5>
                
                <form method="POST" class="mb-5 border-bottom pb-4">
                    <input type="hidden" name="exp_id" value="<?php echo $edit_data['id'] ?? ''; ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Job Title</label>
                            <input type="text" name="job_title" class="form-control" placeholder="e.g. Senior Developer" value="<?php echo $edit_data['job_title'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Company Name</label>
                            <input type="text" name="company_name" class="form-control" placeholder="e.g. Google" value="<?php echo $edit_data['company_name'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g. New York, USA" value="<?php echo $edit_data['location'] ?? ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="<?php echo $edit_data['start_date'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="<?php echo $edit_data['end_date'] ?? ''; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_current" id="is_current" <?php echo (isset($edit_data['is_current']) && $edit_data['is_current'] == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="is_current">I am currently working in this role</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Job Description</label>
                            <textarea name="job_description" class="form-control" rows="4" placeholder="Describe your responsibilities..."><?php echo $edit_data['job_description'] ?? ''; ?></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" name="save_exp" class="btn btn-primary px-5 shadow-sm">
                            <i class="<?php echo ($edit_data) ? 'fas fa-save' : 'fas fa-plus'; ?> me-2"></i>
                            <?php echo ($edit_data) ? 'Update Experience' : 'Add Experience'; ?>
                        </button>
                        
                        <a href="skills.php" class="btn btn-dark px-5 shadow-sm ms-md-2">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </form>

                <h5 class="fw-bold text-dark mt-4">Work History</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Role</th>
                                <th>Company</th>
                                <th>Timeline</th>
                                <th>Location</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($exp_query) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($exp_query)): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $row['job_title']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?php echo date('M Y', strtotime($row['start_date'])); ?> - 
                                            <?php echo ($row['is_current'] ? 'Present' : date('M Y', strtotime($row['end_date']))); ?>
                                        </span>
                                    </td>
                                    <td><?php echo $row['location']; ?></td>
                                    <td class="text-center">
                                        <a href="experience.php?edit=<?php echo $row['id']; ?>" class="text-primary me-3" title="Update"><i class="fas fa-edit"></i></a>
                                        <a href="experience.php?delete=<?php echo $row['id']; ?>" class="text-danger" title="Remove" onclick="return confirm('Are you sure you want to delete this experience?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No work history found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                            <a href="skills.php" class="btn btn-outline-secondary w-100 py-3"><i class="fas fa-code d-block mb-1"></i> Skills</a>
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