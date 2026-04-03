<?php
include 'includes/config.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize input
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $role     = $_POST['role'];

    // Validate empty fields
    if (empty($name) || empty($email) || empty($password) || empty($confirm) || empty($role)) {
        $msg = "All fields are required!";
    }
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format!";
    }
    // Validate role
    elseif (!in_array($role, ['admin', 'student'])) {
        $msg = "Invalid role selected!";
    }
    // Validate password match
    elseif ($password !== $confirm) {
        $msg = "Passwords do not match!";
    } else {
        // Hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Check for duplicate email
        $check = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($check->num_rows > 0) {
            $msg = "Email already registered!";
        } else {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hash, $role);
            if ($stmt->execute()) {
                $msg = "Registered successfully! <a href='login.php' class='load-effect'>Login here</a>.";
            } else {
                $msg = "Something went wrong!";
            }
        }
    }
}


?>










<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | NoteMarket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* BODY */
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: #f5f7fb;
}

/* FULL HEIGHT */
.hero {
  height: 100vh;
}

.form-side {
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px; /* increased */
}

/* FORM CARD */
.form-box {
  width: 100%;
  max-width: 460px; /* increased from 380px */
  background: #ffffff;
  padding: 40px; /* more spacing */
  border-radius: 14px;
  border: 1px solid #e6e9f0;
  box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.form-box h2 {
  font-weight: 600;
  font-size: 26px; /* bigger heading */
  color: #2c3e50;
}

/* INPUT */
.form-control {
  border-radius: 10px;
  padding: 14px; /* bigger input */
  font-size: 15px;
}
/* BUTTON */
.btn-primary {
  background: linear-gradient(135deg, #4e73df, #5a67d8);
  border: none;
  padding: 12px;
  border-radius: 8px;
  font-weight: 600;
  transition: 0.3s;
}

.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 15px rgba(78,115,223,0.3);
}

/* LINKS */
a {
  color: #4e73df;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* RIGHT SIDE */
.image-side {
  background: linear-gradient(135deg, #5f7cff, #6c63ff); /* lighter + modern */
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  padding: 40px;
}

/* SOFT CIRCLES */
.image-side::before {
  content: '';
  position: absolute;
  width: 220px;
  height: 220px;
  background: rgba(255,255,255,0.10);
  border-radius: 50%;
  top: 20px;
  right: 20px;
}

.image-side::after {
  content: '';
  position: absolute;
  width: 160px;
  height: 160px;
  background: rgba(255,255,255,0.06);
  border-radius: 50%;
  bottom: 20px;
  left: 20px;
}

/* IMAGE BOX (NEW - IMPORTANT) */
.image-box {
  background: rgba(255,255,255,0.12);
  padding: 25px;
  border-radius: 16px;
  backdrop-filter: blur(6px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  z-index: 1;
  transition: 0.3s;
}

/* HOVER EFFECT */
.image-box:hover {
  transform: translateY(-5px);
}

/* IMAGE FIX */
.image-side img {
  max-width: 300px;
  width: 100%;
  display: block;
  margin: auto;
  filter: brightness(1.1) contrast(1.1)
          drop-shadow(0 10px 20px rgba(0,0,0,0.2));
}

/* TEXT */
.image-text {
  text-align: center;
  margin-top: 30px;
  z-index: 1;
}

.image-text h4 {
  font-weight: 600;
  font-size: 22px;
}

.image-text p {
  font-size: 14px;
  opacity: 0.95;
}


/* MOBILE */
@media(max-width:768px){
  .image-side {
    display: none;
  }
}


#loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(255, 255, 255, 0.9);
  display: none;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  z-index: 9999;
}

/* Spinner Circle */
.loader-icon {
  font-size: 48px;
  color: #3f51b5;
  animation: spin 1s linear infinite;
}

#loader p {
  margin-top: 15px;
  font-size: 16px;
  color: #3f51b5;
  font-weight: 500;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>

</head>

<body>

<div id="loader">
  <i class="fa-solid fa-spinner fa-spin loader-icon"></i>
  <p>Please wait...</p>
</div>

<div class="container-fluid">
  <div class="row hero">

    <!-- LEFT SIDE -->
    <div class="col-md-6 form-side">

      <div class="form-box">

        <h2 class="mb-4 text-center">Create Account</h2>

        <?php if ($msg): ?>
          <div class="alert alert-warning"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form method="POST">

          <!-- Full Name -->
          <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
          </div>

          <!-- Password -->
          <div class="mb-3">
        <label>Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="password" required placeholder="Create password">
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

          <!-- Confirm Password -->
        <div class="mb-3">
        <label>Confirm Password</label>
        <div class="input-group">
          <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required placeholder="Re-type password">
          <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

          <!-- Account Type -->
               <div class="mb-3">
  <label>Account Type</label>
  <select name="role" class="form-control" required>
    <option value="">-- Select Role --</option>
    <option value="student">Student</option>
    <option value="admin" disabled>Admin (Only for system use)</option>
  </select>
</div>
          <!-- <div class="mb-3">
            <label>Account Type</label>
            <select name="role" class="form-control" required>
              <option value="">-- Select Role --</option>
              <option value="student">Student</option>
              <option value="teacher">Teacher</option>
            </select>
          </div> -->

          <!-- Register Button -->
          <button class="btn btn-primary w-100">Register</button>

        </form>

        <p class="mt-3 text-center">
          Already have an account? <a href="login.php" class="load-effect">Login</a>
        </p>

      </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-6 image-side">

      <!-- CLEAN IMAGE (NO WHITE BG ISSUE) -->
       <div class="image-box">
   <img src="https://img.freepik.com/premium-vector/banner-template-with-school-supplies-frame_572614-353.jpg?w=1380" alt="education"  class="custom-img">
        </div>
      <div class="image-text">
        <h4>Learn Smartly</h4>
        <p>Access notes, practice quizzes, and improve your skills.</p>
      </div>

    </div>

  </div>
</div>



<!-- ✅ JS -->
<script>
  // Toggle password visibility
  document.getElementById('togglePassword').onclick = function () {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
  };

  document.getElementById('toggleConfirm').onclick = function () {
    const input = document.getElementById('confirmPassword');
    input.type = input.type === 'password' ? 'text' : 'password';
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
  };

  // Show loader on form submit


  // Form submit loader
  document.getElementById('registerForm')?.addEventListener('submit', function () {
    document.getElementById('loader').style.display = 'flex';
  });

  // Link click loader
  document.querySelectorAll('a.load-effect').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('loader').style.display = 'flex';
      setTimeout(() => {
        window.location.href = this.href;
      }, 1500);
    });
  });

  window.addEventListener("pageshow", function () {
  const loader = document.getElementById('loader');
  if (loader) loader.style.display = 'none';
});

</script>

</body>
</html>
