<?php
$host   = "localhost";
$user   = "root";
$pass   = "";           
$db     = "portfolio_nayla";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("<div style='color:red;padding:20px;font-family:sans-serif;'>
            Koneksi database gagal: " . $conn->connect_error . "
         </div>");
}
$conn->set_charset("utf8mb4");

$profil = $conn->query("SELECT * FROM profil LIMIT 1")->fetch_assoc();

$skills_result = $conn->query("SELECT * FROM skills");
$skills = [];
while ($row = $skills_result->fetch_assoc()) {
    $skills[] = $row;
}

$exp_result = $conn->query("SELECT * FROM experience");
$experiences = [];
while ($row = $exp_result->fetch_assoc()) {
    $experiences[] = $row;
}
$cert_result = $conn->query("SELECT * FROM certificates");
$certificates = [];
while ($row = $cert_result->fetch_assoc()) {
    $certificates[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Portfolio Nayla</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html { scroll-behavior: smooth; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(180deg, #402B3A 0%, #2b1c27 100%);
      color: white;
    }
    section { padding: 100px 0; }
    .custom-navbar {
      position: fixed;
      bottom: 25px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #402B3A;
      border-radius: 50px;
      padding: 12px 40px;
      border: 2px solid white;
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      z-index: 999;
    }
    .navbar-nav { gap: 30px; }
    .navbar a { color: white !important; font-weight: 500; transition: 0.3s; }
    .navbar a:hover { color: #ffa1ec !important; }
    #home-section { min-height: 100vh; display: flex; align-items: center; }
    #home-section h1,
    #home-section h2 {
      color: #ffa1ec;
      font-weight: 700;
      text-shadow: 0 0 20px rgba(255,161,236,0.5);
    }
    .btn-pink {
      background-color: #ffa1ec;
      border: none;
      color: #402B3A;
      font-weight: 600;
      border-radius: 30px;
      padding: 10px 25px;
      transition: 0.3s;
    }
    .btn-pink:hover { background-color: #ed9ddd; }
    .home-img {
      max-width: 350px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
    @media (max-width: 768px) { .home-img { max-width: 220px; } }
    .text-pink { color: #ffa1ec; font-weight: 600; }
    .experience-box {
      background-color: rgba(255,255,255,0.05);
      padding: 20px;
      border-radius: 15px;
      transition: 0.3s;
    }
    .experience-box:hover {
      background-color: rgba(255,255,255,0.1);
      transform: translateY(-5px);
    }
    .experience-box h5 { color: #ffa1ec; }
    ::-webkit-scrollbar { display: none; }
    .custom-progress {
      height: 20px;
      border-radius: 50px;
      background-color: rgba(255,255,255,0.15);
      overflow: hidden;
    }
    .custom-progress-bar {
      background: linear-gradient(95deg, #ffa1ec, #ff4fd8);
      font-size: 12px;
      font-weight: 600;
    }
    .card {
      background-color: #402B3A;
      border-radius: 20px;
      border: none;
      transition: 0.4s;
      height: 100%;
    }
    .card-title { color: #ffffff; }
    .card-text  { color: #a37aa4; }
    .card:hover { box-shadow: 0 20px 40px rgba(0,0,0,0.25); }
    .certificate-img {
      border-radius: 20px 20px 0 0;
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .spacer { height: 120px; }
  </style>
</head>
<body>
<div id="app">

  <!-- HOME -->
  <section id="home-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center order-1 order-md-2 mt-4 mt-md-0">
          <img src="diri.jpg" class="home-img img-fluid rounded-circle" alt="Foto Profil">
        </div>
        <div class="col-md-6 text-md-start text-center order-2 order-md-1">
          <h1 class="mb-3">HI, I'M</h1>
          <h2 class="mb-3"><?= htmlspecialchars($profil['nama']) ?></h2>
          <p class="mb-4"><?= htmlspecialchars($profil['tagline']) ?></p>
          <a href="#about-section" class="btn btn-pink">Explore More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about-section">
    <div class="container">
      <h2 class="text-center mb-4">About Me</h2>
      <p class="text-center mb-4">
        Saya adalah mahasiswa Sistem Informasi yang memiliki minat pada bidang data analytics,
        database, dan pengembangan web frontend.
      </p>
      <div class="row align-items-start">

        <!-- SKILLS -->
        <div class="col-md-6 mb-5 mt-4">
          <h4 class="mb-4 text-pink">Skills</h4>
          <?php foreach ($skills as $skill): ?>
          <div class="mb-4">
            <label><?= htmlspecialchars($skill['nama']) ?></label>
            <div class="progress custom-progress">
              <div class="progress-bar custom-progress-bar"
                   style="width: <?= (int)$skill['level'] ?>%"></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- EXPERIENCE -->
        <div class="col-md-6 mt-4">
          <h4 class="mb-4 text-pink">Experience</h4>
          <?php foreach ($experiences as $exp): ?>
          <div class="mb-4 experience-box">
            <h5><?= htmlspecialchars($exp['judul']) ?></h5>
            <p><?= htmlspecialchars($exp['deskripsi']) ?></p>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </section>

  <!-- CERTIFICATES -->
  <section id="certificates-section">
    <div class="container">
      <h2 class="text-center mb-5">Certificates</h2>
      <div class="row g-4">
        <?php foreach ($certificates as $cert): ?>
        <div class="col-md-4">
          <div class="card">
            <img src="<?= htmlspecialchars($cert['gambar']) ?>"
                 class="certificate-img"
                 alt="<?= htmlspecialchars($cert['judul']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($cert['judul']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($cert['deskripsi']) ?></p>
              <a href="<?= htmlspecialchars($cert['link']) ?>"
                 target="_blank" class="btn btn-pink btn-sm">View</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <div class="spacer"></div>

  <!-- NAVBAR -->
  <nav class="navbar custom-navbar">
    <ul class="navbar-nav flex-row">
      <li class="nav-item"><a class="nav-link" href="#home-section">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#about-section">About</a></li>
      <li class="nav-item"><a class="nav-link" href="#certificates-section">Certificates</a></li>
    </ul>
  </nav>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
