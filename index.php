<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$is_login = isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CYBER PUNK 3.0 PORTFOLIO - @yousuf_co</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Space+Grotesk:wght@500;700;900&display=swap" rel="stylesheet">
  <style>
    /* ==========================================
       1. VARIABLES & BRUTALIST RESET
       ========================================== */
    :root {
      --bg-dark: #030108;
      --punk-purple: #a855f7;
      --punk-magenta: #ec4899;
      --punk-yellow: #facc15;
      --punk-cyan: #06b6d4;
      --card-bg: #0f0421;
      --text-main: #ffffff;
      --text-muted: #e9d5ff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: var(--bg-dark);
      color: var(--text-main);
      font-family: 'Space Grotesk', sans-serif;
      min-height: 100vh;
      line-height: 1.4;
      padding: 30px 16px;
      /* Halftone Matrix Background - Super Ultra Fast Rendering */
      background-image: 
        radial-gradient(rgba(168, 85, 247, 0.3) 1px, transparent 0),
        radial-gradient(rgba(236, 72, 153, 0.2) 1px, transparent 0);
      background-size: 24px 24px;
      background-position: 0 0, 12px 12px;
      overflow-x: hidden;
    }

    /* CRT Lines Scanline */
    body::before {
      content: " ";
      position: fixed;
      top: 0; left: 0; bottom: 0; right: 0;
      background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.3) 50%);
      background-size: 100% 4px;
      z-index: 999;
      pointer-events: none;
      opacity: 0.5;
    }

    /* NAV / TOP BAR (TOMBOL LOGIN KANAN ATAS) */
    .top-nav {
      max-width: 950px;
      margin: 0 auto 16px auto;
      display: flex;
      justify-content: flex-end;
    }

    .login-nav-btn {
      display: inline-block;
      background: var(--punk-magenta);
      color: #fff;
      padding: 8px 18px;
      border: 3px solid #fff;
      font-weight: 900;
      font-size: 0.95rem;
      text-transform: uppercase;
      text-decoration: none;
      box-shadow: 4px 4px 0px var(--punk-yellow);
      transform: rotate(1.5deg);
      transition: transform 0.15s ease, background 0.15s ease, box-shadow 0.15s ease;
      z-index: 100;
    }

    .login-nav-btn:hover {
      background: var(--punk-yellow);
      color: #000;
      border-color: #000;
      transform: translateY(-2px) rotate(-1deg);
      box-shadow: 6px 6px 0px var(--punk-purple);
    }

    .container {
      max-width: 950px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 36px;
    }

    .marker-font {
      font-family: 'Permanent Marker', cursive;
    }

    /* ==========================================
       2. TAPE & STICKER DECORATIONS (CSS ONLY)
       ========================================== */
    .tape {
      position: absolute;
      width: 90px;
      height: 26px;
      background: rgba(250, 204, 21, 0.35);
      border: 1px dashed rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(2px);
      z-index: 15;
      pointer-events: none;
    }
    .tape-top-left { top: -12px; left: -15px; transform: rotate(-15deg); }
    .tape-bottom-right { bottom: -12px; right: -15px; transform: rotate(-10deg); background: rgba(236, 72, 153, 0.35); }

    .sticker-tag {
      position: absolute;
      padding: 4px 12px;
      font-weight: 900;
      font-size: 0.8rem;
      border: 2px solid #000;
      box-shadow: 3px 3px 0px #000;
      text-transform: uppercase;
      z-index: 10;
    }

    .sticker-1 {
      top: -14px; right: 20px;
      background: var(--punk-yellow); color: #000;
      transform: rotate(4deg);
    }

    .sticker-2 {
      bottom: -12px; left: 24px;
      background: var(--punk-magenta); color: #fff;
      transform: rotate(-3deg);
    }

    /* ==========================================
       3. ULTRA PUNK CARDS WITH GLOW BORDER
       ========================================== */
    .punk-card {
      background: var(--card-bg);
      border: 3px solid #fff;
      border-radius: 4px;
      padding: 28px;
      box-shadow: 8px 8px 0px var(--punk-purple);
      position: relative;
      will-change: transform;
      transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.2s ease;
      animation: fadeInUp 0.5s ease-out forwards;
    }

    .punk-card:hover {
      transform: translateY(-5deg) scale(1.005);
      box-shadow: 12px 12px 0px var(--punk-magenta);
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* HERO PROFILE */
    .profile-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 24px;
      background: linear-gradient(135deg, #180630 0%, #0d021d 100%);
      border: 4px solid #fff;
      box-shadow: 10px 10px 0px var(--punk-magenta);
    }

    @media (min-width: 640px) {
      .profile-card {
        flex-direction: row;
        text-align: left;
        padding: 36px;
      }
    }

    .avatar-wrapper {
      position: relative;
      width: 135px;
      height: 135px;
      flex-shrink: 0;
    }

    .avatar-img {
      width: 100%;
      height: 100%;
      border-radius: 6px;
      object-fit: cover;
      border: 4px solid var(--punk-yellow);
      box-shadow: 6px 6px 0px #000;
    }

    .status-badge {
      position: absolute;
      top: -10px; right: -10px;
      background: var(--punk-cyan); color: #000;
      font-weight: 900; font-size: 0.75rem;
      padding: 2px 8px; border: 2px solid #000;
      transform: rotate(8deg);
      box-shadow: 2px 2px 0px #000;
    }

    .glitch-title {
      font-size: 3.4rem;
      font-weight: 900;
      color: #fff;
      text-transform: uppercase;
      display: inline-block;
      text-shadow: 4px 4px 0px var(--punk-magenta), -2px -2px 0px var(--punk-cyan);
      letter-spacing: -1px;
      line-height: 1;
    }

    .username {
      display: inline-block;
      background: var(--punk-purple);
      color: #fff; font-weight: 700; font-size: 0.95rem;
      padding: 3px 10px; border: 2px solid #000;
      transform: rotate(-2deg); margin-bottom: 8px;
    }

    .role {
      font-size: 1.1rem;
      color: var(--punk-yellow);
      font-weight: 900;
      letter-spacing: 2px;
      margin-bottom: 10px;
    }

    .bio {
      color: var(--text-muted);
      font-size: 1rem;
      margin-bottom: 16px;
      max-width: 600px;
    }

    .location {
      display: inline-block;
      background: var(--punk-cyan);
      color: #000; font-size: 0.85rem; font-weight: 900;
      padding: 4px 12px; border: 2px solid #000;
      transform: rotate(1deg);
    }

    /* SKILLS & PROGRESS */
    .section-title {
      font-size: 2rem;
      font-weight: 900;
      margin-bottom: 20px;
      color: var(--punk-yellow);
      text-transform: uppercase;
      text-shadow: 3px 3px 0px #000;
    }

    .skills-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .skill-tag {
      background: #000;
      border: 2px solid var(--punk-magenta);
      padding: 8px 16px;
      font-size: 0.95rem;
      font-weight: 700;
      color: #fff;
      box-shadow: 4px 4px 0px var(--punk-purple);
      transition: transform 0.15s ease, background 0.15s ease;
      cursor: default;
    }

    .skill-tag:hover {
      background: var(--punk-yellow);
      color: #000;
      border-color: #000;
      transform: translateY(-3px) rotate(-2deg);
      box-shadow: 6px 6px 0px var(--punk-magenta);
    }

    .progress-box {
      margin-top: 24px;
      background: #000;
      padding: 18px;
      border: 3px solid var(--punk-purple);
      box-shadow: 5px 5px 0px #fff;
    }

    .progress-header {
      display: flex;
      justify-content: space-between;
      font-size: 0.95rem; font-weight: 900;
      margin-bottom: 8px; color: var(--punk-yellow);
    }

    .progress-bar-bg {
      width: 100%; height: 16px;
      background: #220845;
      border: 2px solid #fff;
    }

    .progress-bar-fill {
      height: 100%; width: 85%;
      background: linear-gradient(90deg, var(--punk-magenta), var(--punk-yellow));
    }

    /* PROJECTS GRID */
    .filter-tabs {
      display: flex;
      gap: 12px;
      margin-bottom: 22px;
      overflow-x: auto;
      padding-bottom: 6px;
    }

    .tab-btn {
      background: #000;
      border: 3px solid #fff;
      color: #fff;
      padding: 10px 18px;
      font-size: 0.9rem;
      font-weight: 900;
      text-transform: uppercase;
      box-shadow: 4px 4px 0px var(--punk-purple);
      transition: transform 0.15s ease, background 0.15s ease;
      white-space: nowrap;
      cursor: pointer;
    }

    .tab-btn.active, .tab-btn:hover {
      background: var(--punk-magenta);
      color: #fff;
      border-color: #000;
      transform: translateY(-2px);
      box-shadow: 6px 6px 0px var(--punk-yellow);
    }

    .projects-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    @media (min-width: 640px) {
      .projects-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    .project-card {
      background: #000;
      border: 3px solid #fff;
      padding: 22px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 6px 6px 0px var(--punk-purple);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      cursor: pointer;
    }

    .project-card:hover {
      border-color: var(--punk-yellow);
      transform: translateY(-4px) rotate(0.5deg);
      box-shadow: 9px 9px 0px var(--punk-magenta);
    }

    .project-title {
      font-size: 1.35rem; font-weight: 900;
      color: var(--punk-yellow);
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    .project-desc {
      font-size: 0.95rem;
      color: var(--text-muted);
      margin-bottom: 18px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .project-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: auto;
    }

    .project-tag {
      font-size: 0.8rem; font-weight: 900; color: #000;
      background: var(--punk-cyan);
      padding: 4px 10px; border: 2px solid #000;
      text-transform: uppercase;
    }

    .view-btn {
      font-size: 0.85rem; color: var(--punk-yellow);
      font-weight: 900; text-transform: uppercase;
    }

    /* CTA LINK & MODAL */
    .cta-container {
      text-align: center;
      margin-top: 10px;
    }

    .hall-btn {
      display: inline-block;
      background: var(--punk-yellow);
      color: #000;
      padding: 16px 36px;
      border: 4px solid #000;
      font-weight: 900;
      font-size: 1.25rem;
      text-transform: uppercase;
      box-shadow: 8px 8px 0px var(--punk-magenta);
      transition: transform 0.15s ease, background 0.15s ease;
      transform: rotate(-1deg);
      cursor: pointer;
    }

    .hall-btn:hover {
      background: var(--punk-magenta);
      color: #fff;
      transform: translateY(-3px) rotate(1deg);
      box-shadow: 10px 10px 0px var(--punk-purple);
    }

    .modal-overlay {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(3, 1, 8, 0.9);
      backdrop-filter: blur(6px);
      display: flex; justify-content: center; align-items: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.2s ease;
      z-index: 1000; padding: 16px;
    }

    .modal-overlay.active {
      opacity: 1; pointer-events: all;
    }

    .modal-content {
      background: #000;
      border: 4px solid var(--punk-yellow);
      padding: 28px; max-width: 500px; width: 100%;
      position: relative;
      box-shadow: 10px 10px 0px var(--punk-purple);
    }

    .close-modal {
      position: absolute; top: 10px; right: 12px;
      background: var(--punk-magenta);
      border: 2px solid #000; color: #fff;
      font-size: 1.2rem; font-weight: 900;
      width: 32px; height: 32px; cursor: pointer;
    }

    .close-modal:hover {
      background: var(--punk-yellow); color: #000;
    }
  </style>
</head>
<body>

  <!-- TOMBOL LOGIN / DASHBOARD DI KANAN ATAS -->
  <nav class="top-nav">
    <?php if ($is_login): ?>
      <a href="dashboard.php" class="login-nav-btn marker-font">⚡ DASHBOARD (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
    <?php else: ?>
      <a href="login.php" class="login-nav-btn marker-font">🔑 LOGIN ➔</a>
    <?php endif; ?>
  </nav>

  <div class="container">
    
    <!-- HERO SECTION -->
    <header class="punk-card profile-card">
      <div class="tape tape-top-left"></div>
      <span class="sticker-tag sticker-1">100% PUNK ⚡</span>
      <div class="avatar-wrapper">
        <img src="Kuncup.jpg" alt="Foto Profil" class="avatar-img" id="avatarImg" onerror="this.src='https://api.dicebear.com/7.x/bottts/svg?seed=yousuf'">
        <span class="status-badge">ONLINE</span>
      </div>
      <div class="profile-info">
        <div class="username" id="usernameText">@yousuf_co</div>
        <br>
        <h1 class="glitch-title" id="nameText">YOUSUF</h1>
        <div class="role marker-font" id="roleText">CREATIVE TECHNOLOGIST & TRADER</div>
        <p class="bio" id="bioText">
          Fokus pada pengembangan UI/UX interaktif dan analisis pasar keuangan. Estetika brutalist, minimalis, dan penuh energi rock!
        </p>
        <div class="location">
          📍 <span id="locationText">SAMARINDA, KALIMANTAN TIMUR</span>
        </div>
      </div>
    </header>

    <!-- SKILLS SECTION -->
    <section class="punk-card">
      <span class="sticker-tag sticker-2">NO RULES 🤘</span>
      <h2 class="section-title marker-font">⚡ SKILLS & STUFF</h2>
      <div class="skills-wrapper" id="skillsContainer"></div>

      <div class="progress-box">
        <div class="progress-header">
          <span>NOW LEARNING: <strong>WEB ARCHITECTURE & XAUUSD ANALYSIS</strong></span>
          <span>85%</span>
        </div>
        <div class="progress-bar-bg">
          <div class="progress-bar-fill"></div>
        </div>
      </div>
    </section>

    <!-- CREATIONS / PROJECTS SECTION -->
    <section class="punk-card">
      <div class="tape tape-bottom-right"></div>
      <h2 class="section-title marker-font">🔥 CREATIONS & PROJECTS</h2>
      
      <div class="filter-tabs" id="filterTabs">
        <button class="tab-btn active" data-category="all">SEMUA</button>
        <button class="tab-btn" data-category="web">WEB DEV</button>
        <button class="tab-btn" data-category="ui">UI/UX DESIGN</button>
        <button class="tab-btn" data-category="finance">FINANCE TOOL</button>
      </div>

      <div class="projects-grid" id="projectsGrid"></div>
    </section>

    <!-- CTA LINK -->
    <div class="cta-container">
      <button class="hall-btn marker-font" id="hallBtn">
        🏆 HALL OF CREATIONS ➔
      </button>
    </div>

  </div>

  <!-- MODAL -->
  <div class="modal-overlay" id="projectModal">
    <div class="modal-content">
      <button class="close-modal" id="closeModal">&times;</button>
      <h3 id="modalTitle" style="margin-bottom: 10px; color: var(--punk-yellow); font-size: 1.5rem;" class="marker-font">Title</h3>
      <p id="modalDesc" style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px;">Description</p>
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <span class="project-tag" id="modalTag">Category</span>
        <button class="tab-btn active" style="padding: 6px 14px; font-size: 0.8rem;" onclick="alert('Membuka tautan project...')">BUKA PROJECT ➔</button>
      </div>
    </div>
  </div>

  <!-- LIGHTWEIGHT JAVASCRIPT DOM LOGIC -->
  <script>
    // Web Audio API Ringan (Audio Synth tanpa lag)
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    function playClickSound(freq = 400, type = 'sine') {
      if (audioCtx.state === 'suspended') audioCtx.resume();
      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();
      osc.type = type;
      osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
      gain.gain.setValueAtTime(0.04, audioCtx.currentTime);
      gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.08);
      osc.connect(gain);
      gain.connect(audioCtx.destination);
      osc.start();
      osc.stop(audioCtx.currentTime + 0.08);
    }

    // Data Portfolio
    const skillsData = ["HTML5/CSS3", "JavaScript DOM", "UI/UX Design", "Brutalist Layout", "Technical Analysis", "Exness Platform"];

    const projectsData = [
      {
        id: 1,
        title: "FiveCoffe Dashboard",
        category: "web",
        categoryLabel: "Web Dev",
        desc: "Sistem kasir & kontrol stok interaktif berbasis web untuk kedai kopi pinggir jalan."
      },
      {
        id: 2,
        title: "XAUUSD Trend Tracker",
        category: "finance",
        categoryLabel: "Finance Tool",
        desc: "Kalkulator Pips & indikator risiko harian khusus analisa pergerakan harga Emas."
      },
      {
        id: 3,
        title: "Punk Cyber Profile",
        category: "ui",
        categoryLabel: "UI/UX Design",
        desc: "Desain portofolio bergaya Pop-Punk Rock dengan tipografi berani & neon kontras."
      },
      {
        id: 4,
        title: "Personal Finance Calculator",
        category: "finance",
        categoryLabel: "Finance Tool",
        desc: "Widget manajemen keuangan pribadi interaktif menggunakan manipulasi DOM JS."
      }
    ];

    const skillsContainer = document.getElementById('skillsContainer');
    const projectsGrid = document.getElementById('projectsGrid');
    const filterTabs = document.getElementById('filterTabs');
    const projectModal = document.getElementById('projectModal');
    const closeModal = document.getElementById('closeModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalTag = document.getElementById('modalTag');
    const hallBtn = document.getElementById('hallBtn');

    function renderSkills() {
      skillsContainer.innerHTML = skillsData.map(skill => 
        `<span class="skill-tag" onmouseenter="playClickSound(600, 'triangle')">${skill}</span>`
      ).join('');
    }

    function renderProjects(category = 'all') {
      const filtered = category === 'all' 
        ? projectsData 
        : projectsData.filter(p => p.category === category);

      if (filtered.length === 0) {
        projectsGrid.innerHTML = `<p style="color: var(--punk-yellow); grid-column: 1/-1; text-align: center; font-weight:900;">PROJECT TIDAK DITEMUKAN!</p>`;
        return;
      }

      projectsGrid.innerHTML = filtered.map(item => `
        <div class="project-card" onclick="openModal(${item.id})" onmouseenter="playClickSound(500, 'triangle')">
          <div>
            <div class="project-title">${item.title}</div>
            <div class="project-desc">${item.desc}</div>
          </div>
          <div class="project-footer">
            <span class="project-tag">${item.categoryLabel}</span>
            <span class="view-btn">LIHAT ➔</span>
          </div>
        </div>
      `).join('');
    }

    filterTabs.addEventListener('click', (e) => {
      if (e.target.classList.contains('tab-btn')) {
        playClickSound(800, 'square');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
        const category = e.target.getAttribute('data-category');
        renderProjects(category);
      }
    });

    window.openModal = function(id) {
      playClickSound(300, 'sawtooth');
      const project = projectsData.find(p => p.id === id);
      if (project) {
        modalTitle.textContent = project.title;
        modalDesc.textContent = project.desc;
        modalTag.textContent = project.categoryLabel;
        projectModal.classList.add('active');
      }
    };

    closeModal.addEventListener('click', () => {
      playClickSound(200, 'sine');
      projectModal.classList.remove('active');
    });

    projectModal.addEventListener('click', (e) => {
      if (e.target === projectModal) projectModal.classList.remove('active');
    });

    hallBtn.addEventListener('click', () => {
      playClickSound(900, 'sawtooth');
      alert('ROCK ON! 🎸 Selamat datang di Hall of Creations!');
    });

    document.addEventListener('DOMContentLoaded', () => {
      renderSkills();
      renderProjects();
    });
  </script>
</body>
</html>