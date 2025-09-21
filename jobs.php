<?php
include 'db_connect.php'; // connection file
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jobs - JobLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: linear-gradient(135deg, #0d1b2a, #1b263b); color:#fff; font-family:'Segoe UI',sans-serif; min-height:100vh;}
    .navbar {background: rgba(0,0,0,0.85)!important; backdrop-filter: blur(10px);}
    .navbar .navbar-brand {color:#00d8ff; font-weight:600;}
    .btn-primary {background:#00d8ff; border:none; box-shadow:0 0 20px #00d8ff; color:#fff;}
    .btn-primary:hover {box-shadow:0 0 35px #00ffff; transform:scale(1.05);}
    .btn-outline-secondary {border-color:#00d8ff; color:#00d8ff; background:transparent;}
    .btn-outline-secondary:hover {background:#00d8ff; color:#fff; transform:scale(1.05);}
    .job-card {padding:1rem; border-radius:12px; transition:0.3s; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);}
    .job-card:hover {transform:translateY(-5px); box-shadow:0 0 25px rgba(0,216,255,0.5);}
    .salary {font-weight:bold; color:#00d8ff;}
    main {padding-top:90px;}
    .gradient-text {background:linear-gradient(90deg,#00d8ff,#ff6ec4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; font-weight:600;}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.html"><i class="fa-solid fa-briefcase me-2"></i>JobLink</a>
    <div class="ms-auto">
      <a class="btn btn-outline-secondary me-2" href="dashboard.html">Dashboard</a>
      <a class="btn btn-primary" href="post-job.html">Post Job</a>
    </div>
  </div>
</nav>

<main class="container">
  <div class="row">
    <!-- Filters -->
    <aside class="col-lg-3">
      <div class="card p-3 shadow-sm">
        <h6 class="text-primary">Filters</h6>
        <label class="form-label small mt-2">Category</label>
        <select id="filterCategory" class="form-select mb-2">
          <option value="">All</option>
          <option>Software</option>
          <option>Design</option>
          <option>Data</option>
          <option>HR</option>
        </select>
        <label class="form-label small">Location</label>
        <input id="filterLocation" class="form-control mb-2" placeholder="City or Remote">
        <label class="form-label small">Minimum salary (LPA)</label>
        <input id="filterSalary" type="number" class="form-control mb-2" placeholder="5">
        <button id="applyFilters" class="btn btn-primary w-100 mb-2">Apply</button>
        <button id="resetFilters" class="btn btn-link w-100 text-info">Reset</button>
      </div>
    </aside>

    <!-- Job Listings -->
    <section class="col-lg-9">
      <div id="jobsList" class="row g-4">
        <?php
        $sql = "SELECT * FROM post_jobs ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6 col-lg-4">
                        <div class="job-card">
                          <h5>' . htmlspecialchars($row["job_title"]) . '</h5>
                          <p class="small text-muted">' . htmlspecialchars($row["job_location"]) . ' • ' . htmlspecialchars($row["job_category"]) . '</p>
                          <p>' . htmlspecialchars(substr($row["job_description"],0,80)) . '...</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <span class="salary">₹' . htmlspecialchars($row["salary_lpa"]) . ' LPA</span>
                            <a href="apply-job.html?job_id='.$row["job_id"].'" class="btn btn-sm btn-primary">Apply</a>
                          </div>
                        </div>
                      </div>';
            }
        } else {
            echo "<p class='text-center'>❌ No jobs available yet.</p>";
        }
        ?>
      </div>

      <!-- Trusted Profiles Section -->
      <div class="mt-5 p-3 text-center">
        <h5 class="gradient-text">Trusted Profiles — Shraddha, Shravani, Janhavi, Sakshi</h5>
      </div>
    </section>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
