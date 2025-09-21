<?php
include 'db_connect.php';

// For now, assume logged-in user_id = 1
$user_id = 1;

// Fetch user profile
$user_sql = "SELECT * FROM users WHERE user_id = $user_id";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();

// Fetch recent applications
$app_sql = "SELECT a.*, j.job_title, j.company_id, c.company_name
            FROM applications a
            JOIN jobs j ON a.job_id = j.job_id
            JOIN companies c ON j.company_id = c.company_id
            WHERE a.user_id = $user_id
            ORDER BY a.applied_at DESC
            LIMIT 5";
$app_result = $conn->query($app_sql);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard - JobLink</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
  body {font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); color:#fff; min-height:100vh;}
  .navbar {background: rgba(255,255,255,0.05)!important; backdrop-filter: blur(6px);}
  .section-heading {font-weight:700; margin-bottom:1rem; color:#00d4ff; text-shadow:0 0 6px #00d4ff;}
  .glass-card {background:rgba(255,255,255,0.05); border-radius:12px; padding:1rem; margin-bottom:1rem; backdrop-filter:blur(10px);}
  table {color:#ffffff;}
  .badge {font-weight:500;}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="index.html">
      <i class="fa-solid fa-briefcase me-2"></i>JobLink
    </a>
    <div class="ms-auto">
      <a class="btn btn-outline-light me-2" href="jobs.php">Browse Jobs</a>
      <a class="btn btn-primary" href="post-job.html">Post a Job</a>
    </div>
  </div>
</nav>

<main class="container py-5" style="padding-top:100px;">
  <h2 class="section-heading">Hello, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>

  <div class="row g-4">
    <!-- Profile -->
    <div class="col-lg-4">
      <div class="glass-card">
        <h6>Profile</h6>
        <p class="small"><?php echo htmlspecialchars($user['full_name']); ?> • <?php echo ucfirst($user['role']); ?></p>
        <a class="btn btn-sm btn-outline-info" href="#">Edit Profile</a>
      </div>
      <div class="glass-card">
        <h6>Saved Jobs</h6>
        <p class="small">Feature coming soon...</p>
        <a class="btn btn-sm btn-info" href="jobs.php">View Jobs</a>
      </div>
    </div>

    <!-- Applications -->
    <div class="col-lg-8">
      <h6 class="section-heading">Recent Applications</h6>
      <div class="glass-card">
        <table class="table table-borderless mb-0">
          <thead>
            <tr>
              <th>Job</th>
              <th>Company</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($app_result->num_rows > 0) {
                while ($row = $app_result->fetch_assoc()) {
                    echo "<tr>
                            <td>".htmlspecialchars($row['job_title'])."</td>
                            <td>".htmlspecialchars($row['company_name'])."</td>
                            <td><span class='badge bg-warning text-dark'>Under review</span></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No applications yet.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
