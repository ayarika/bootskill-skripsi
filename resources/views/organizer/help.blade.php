<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help</title>
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      transition: filter 0.3s ease;
    }

    .sidebar {
      width: 200px;
      height: 100vh;
      background: linear-gradient(to bottom, #66aef6ff, #79beedff);
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      transition: transform 0.32s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform;
      padding-top: 60px;
      overflow-x: hidden;
      z-index: 1000;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 15px 20px;
      text-decoration: none;
      white-space: nowrap;
    }

    .sidebar a:hover {
      color: #fff;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      transition: background-color 0.15s ease;
    }

    .hamburger-btn {
      position: fixed;
      top: 15px;
      left: 15px;
      background: transparent;
      color: #2e4a59;
      border: none;
      font-size: 24px;
      cursor: pointer;
      z-index: 3000;
      padding: 5px 10px;
      border-radius: 6px;
      transition: color 0.3s ease;
    }

    .hamburger-btn svg {
      width: 30px;
      height: 30px;
      fill: currentColor;
      transition: fill 0.2s ease;
    }

    .hamburger-btn.active {
      color: #fff;
    }

    .close-btn {
      position: absolute;
      top: 15px;
      right: 20px;
      background: transparent;
      border: none;
      color: white;
      font-size: 22px;
      cursor: pointer;
      display: none;
      z-index: 3001;
    }

    .main-content {
      margin-left: 200px;
      padding: 80px 40px 40px 40px;
      transition: margin-left 0.32s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        width: 100%;
        height: 100vh;
        transform: translateX(-100%);
        z-index: 2500;
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .close-btn {
        display: block;
      }

      .main-content {
        margin-left: 0 !important;
        padding: 70px 20px 20px 20px;
      }
    }

    .page-title {
      font-size: 32px;
      font-weight: 700;
      color: #2e3a59;
      margin-bottom: 15px;
      padding-bottom: 8px;
    }

    .page-subtitle {
      font-size: 18px;
      color: #888;
      margin-bottom: 40px;
    }

    .faq-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      max-width: 900px;
    }

    .faq-item {
      background: #fff;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
      cursor: pointer;
    }

    .faq-question {
      font-size: 18px;
      font-weight: bold;
      color: #2e3a59;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
    }

    .faq-answer {
      display: none;
      margin-top: 10px;
      color: #444;
      line-height: 1.6;
    }

    .faq-item.active .faq-answer {
      display: block;
      margin-top: 10px;
      color: #555;
      line-height: 1.6;
    }

    .faq-item.active .faq-question::after {
      content: "▲";
      font-size: 14px;
    }

    .faq-question::after {
      content: "▼";
      font-size: 14px;
      color: #2e3a59;
    }

    a.link {
      color: #1a73e8;
      text-decoration: underline;
    }

    a.link:hover {
      color: #0f53c0;
    }

    @media (min-width: 769px) {
      .sidebar.desktop-closed {
        transform: translateX(-100%);
      }

      .main-content {
        margin-left: 200px;
      }

      .main-content.collapsed {
        margin-left: 0;
      }
    }

    .logout-form {
      margin: 0;
    }

    .logout-btn {
      display: block;
      width: 100%;
      background: transparent;
      border: none;
      color: white;
      padding: 15px 20px;
      text-align: left;
      font-size: 1rem;
      cursor: pointer;
      white-space: nowrap;
    }

    .logout-btn:hover {
      background: rgba(255,255, 255, 0.2);
      border-radius: 6px;
    }
  </style>
</head>
<body>
    <button id="hamburgerbtn" class="hamburger-btn">
      <svg width="30" height="30" viewBox="0 0 100 80" fill="currentColor" aria-hidden="true">
        <rect width="100" height="10"></rect>
        <rect y="30" width="100" height="10"></rect>
        <rect y="60" width="100" height="10"></rect>
      </svg>
    </button>
    
    <div id="sidebar" class="sidebar">
      <button id="closeSidebarBtn" class="close-btn">✕</button>
      <a href="{{ route('organizer.home') }}">Home</a>
      <a href="{{ route('organizer.yourevent') }}">Your Event</a>
      <a href="{{ route('organizer.help') }}">Help</a>
      <form action="{{ route('logout') }}" method="GET" class="logout-form">
        <button type="submit" class="logout-btn">Sign Out</button>
      </form>
    </div>

    <div id="main-content" class="main-content">
      <h1 class="page-title">Help</h1>
      <p class="page-subtitle">Here are some common questions and answers to guide organizers.</p>

      <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question"> How do I create a new event?</div>
            <div class="faq-answer">Go to the <b>Your Event</b> page and click on the <b>Create Event</b> button. Fill out the form and save it.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">How can I view participant transactions and attendance?</div>
            <div class="faq-answer">Navigate to <b>Transaction and Attendance</b> from your Organizer Home. You'll find detailed information for each bootcamp.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">How do I edit my organizer profile?</div>
            <div class="faq-answer">Click the <b>Edit Profile</b> button in the Home Menu to update your name, description, profile picture, and social media links.</div>
        </div>

        <div class="faq-item">
          <div class="faq-question">Need more help?</div>
          <div class="faq-answer">Contact our support team through the <a href="/contactuslan" class="link">Contact Us</a> page.</div>
        </div>
      </div>
    </div>

    <script>

      const sidebar = document.getElementById("sidebar");
      const hamburgerBtn = document.getElementById("hamburgerbtn");
      const closeSidebarBtn = document.getElementById("closeSidebarBtn");
      const mainContent = document.getElementById("main-content");

      function isMobileView() {
        return window.innerWidth <= 768;
      }

      function updateHamburgerColor() {
        if (isMobileView()) {
          hamburgerBtn.classList.toggle("active", sidebar.classList.contains("active"));
        } else {
          hamburgerBtn.classList.toggle(
            "active",
            !sidebar.classList.contains("desktop-closed")
          );
        }
      }

      function closeSidebarDesktop() {
        sidebar.classList.add("desktop-closed");
        mainContent.classList.add("collapsed");
        updateHamburgerColor();
      }

      function openSidebarDesktop() {
        sidebar.classList.remove("desktop-closed");
        mainContent.classList.remove("collapsed");
        updateHamburgerColor();
      }

      hamburgerBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        
        if (isMobileView()) {
          sidebar.classList.toggle("active");
        } else {
          sidebar.classList.toggle("desktop-closed");
          mainContent.classList.toggle("collapsed");
        }

        updateHamburgerColor();
      });

      closeSidebarBtn.addEventListener("click", () => {
        if (isMobileView()) {
          sidebar.classList.remove("active");
          updateHamburgerColor();
        }
      });

      document.addEventListener("click", (e) => {
        if (
          isMobileView() &&
          sidebar.classList.contains("active") &&
          !sidebar.contains(e.target) &&
          e.target !== hamburgerBtn
        ) {
          sidebar.classList.remove("active");
          updateHamburgerColor();
        }
      });

      window.addEventListener("resize", () => {
        if (isMobileView()) {
          sidebar.classList.remove("desktop-closed");
          sidebar.classList.remove("active");
          mainContent.classList.remove("collapsed");
        }
        updateHamburgerColor();
      });

      updateHamburgerColor();

      document.querySelectorAll(".faq-item").forEach(item => {
        item.addEventListener("click", () => {
          item.classList.toggle("active");
        });
      });

    </script>

</body>
</html>
