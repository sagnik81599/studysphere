<?php
include '../includes/config.php';
include '../includes/auth_student.php'; // Ensure only students can access
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard | NoteMarket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom Styling -->
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    /* Logo */
/* LOGO */
.logo-img {
  height: 52px;
  width: auto;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.logo-img:hover {
  transform: scale(1.05);
}

/* NAVBAR */
.navbar {
  border-bottom: 1px solid #eef1f6;
}

/* NAV LINKS */
.navbar .nav-link {
  font-weight: 500;
  color: #555;
  margin: 0 10px;
  position: relative;
  transition: all 0.3s ease;
}

.navbar .nav-link:hover {
  color: #4e73df;
}

/* ACTIVE LINK */
.navbar .nav-link.active {
  color: #4e73df;
  font-weight: 600;
}

.navbar .nav-link.active::after {
  content: "";
  position: absolute;
  width: 60%;
  height: 2px;
  background: #4e73df;
  bottom: -5px;
  left: 20%;
  border-radius: 2px;
}

/* USER BUTTON */
.user-box {
  background: linear-gradient(135deg, #4e73df, #6c8cff);
  color: #fff;
  border-radius: 50px;
  padding: 8px 16px;
  font-weight: 500;
  border: none;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
}

.user-box:hover {
  background: linear-gradient(135deg, #3c5edc, #5a78ff);
  transform: translateY(-1px);
}

/* ICON */
.user-box i {
  font-size: 18px;
}

/* DROPDOWN MENU */
.profile-menu {
  border-radius: 12px;
  border: none;
  padding: 10px 0;
  min-width: 220px;
}

/* DROPDOWN ITEMS */
.profile-menu .dropdown-item {
  padding: 10px 18px;
  font-size: 14px;
  transition: all 0.2s ease;
}

.profile-menu .dropdown-item:hover {
  background: #f5f7ff;
  color: #4e73df;
}

/* USER INFO */
.profile-menu strong {
  font-size: 15px;
}

.profile-menu small {
  font-size: 12px;
}

/* MOBILE FIX */
@media (max-width: 991px) {
  .nav-center {
    text-align: center;
    margin-top: 10px;
  }

  .navbar .nav-link {
    margin: 8px 0;
  }

  .user-box {
    width: 100%;
    justify-content: center;
  }
}

    /* HTML: <div class="loader"></div> */
/* HTML: <div class="loader"></div> */
     /* Fullscreen overlay */
.loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  z-index: 9999;
  display: none;
  justify-content: center;
  align-items: center;
}

/* Spinner styling */
.spinner {
  width: 60px;
  height: 60px;
  border: 6px solid #add8e6;
  border-top: 6px solid #007bff;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

/* Animation */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
.hover-shadow:hover {
  transform: translateY(-4px);
  transition: all 0.3s ease-in-out;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.card-title {
  font-weight: 600;
}

.dashboard-heading {
  font-size: 1.8rem;
}

@media (max-width: 576px) {
  .dashboard-heading {
    font-size: 1.5rem;
  }
}



  </style>
</head>
<body>
  <!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
  <div class="container-fluid px-5">

    <!-- LOGO -->
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <img src="smartLeran AI.png" alt="logo" class="logo-img">
    </a>

    <!-- TOGGLE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- CONTENT -->
    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- CENTER LINKS -->
      <ul class="navbar-nav mx-auto nav-center">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="features.php">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="notes.php">Notes</a></li>
        <li class="nav-item"><a class="nav-link" href="quiz.php">Test</a></li>
        <li class="nav-item"><a class="nav-link" href="certificate.php">Certificates</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>

      <!-- RIGHT SIDE -->
      <div class="d-flex align-items-center gap-3">

        <!-- USER -->
      

        <!-- LOGOUT -->
     <div class="dropdown">
  <button class="btn user-box dropdown-toggle" type="button" data-bs-toggle="dropdown">

    <i class="bi bi-person-circle"></i>
    <?php echo $_SESSION['name']; ?>

  </button>

  <ul class="dropdown-menu dropdown-menu-end shadow profile-menu">

    <li class="px-3 py-2 border-bottom">
      <strong><?php echo $_SESSION['name']; ?></strong><br>
      <small class="text-muted"><?php echo $_SESSION['email']; ?></small>
    </li>

    <li><a class="dropdown-item" href="profile.php">👤 My Profile</a></li>
    <li><a class="dropdown-item" href="settings.php">⚙️ Settings</a></li>

    <li><hr class="dropdown-divider"></li>

    <li>
      <a class="dropdown-item text-danger" href="logout.php">🚪 Logout</a>
    </li>

  </ul>
</div>

      </div>

    </div>
  </div>
</nav>
<!-- ✅ Main Dashboard Content -->
<div class="container my-5">
  <div class="text-center mb-4">
    <h2 class="dashboard-heading fw-bold text-primary">
      👋 Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>
    </h2>
    <p class="text-muted">Select a category to explore handwritten study notes.</p>
  </div>

  <!-- Notes Section -->
  <div class="row g-4">
    <!-- Free Notes -->
    <div class="col-md-6">
      <a href="notes.php?type=free" class=" load-effect text-decoration-none">
        <div class="card h-100 shadow-sm border-0 hover-shadow transition">
          <div class="card-body">
            <h5 class="card-title text-primary">📘 Free Notes</h5>
            <p class="card-text text-muted">Browse and download freely available handwritten notes from students.</p>
          </div>
        </div>
      </a>
    </div>

    <!-- Premium Notes -->
    <div class="col-md-6">
      <a href="notes.php?type=premium" class="load-effect text-decoration-none">
        <div class="card h-100 bg-light shadow-sm border-0 hover-shadow transition">
          <div class="card-body">
            <h5 class="card-title text-dark">💎 Premium Notes</h5>
            <p class="card-text text-muted">Unlock high-quality premium notes. (Paid feature coming soon)</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>


<div class="loader-overlay" id="loader">
  <div class="spinner"></div>
</div>

<!-- Responsive Dashboard Navbar -->


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Hide loader on page load (even after back/forward)
  window.addEventListener('pageshow', function () {
    const loader = document.getElementById('loader');
    if (loader) {
      loader.style.display = 'none';
    }
  });

  // Loader logic when clicking a link
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('a.load-effect').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('loader').style.display = 'flex';

        setTimeout(() => {
          window.location.href = this.href;
        }, 1500);
      });
    });
  });
</script>



</body>
</html>
