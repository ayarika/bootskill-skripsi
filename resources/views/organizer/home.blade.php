<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>

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
      transition: all 0.3s ease, transform 0.3s ease;
      padding-top: 60px;
      overflow-x: hidden;
      z-index: 1000;
    }

    .sidebar.collapsed {
      transform: translateX(-100%);
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
      transition: all 0.2s ease;
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

    .main-content {
      position: relative;
      z-index: 1;
      margin-left: 200px;
      padding: 40px 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    .dropdown-section {
      margin-left: 200px;
      padding: 0 30px 40px;
      transition: margin-left 0.3s ease;
    }

    .dropdown-section.collapsed {
      margin-left: 0;
    }

    @media (max-width: 768px) {
      body {
        overflow-x: hidden;
      }

      .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: #2e3a59;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 2500;
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .close-btn {
        display: block;
      }

      .main-content,
      .dropdown-section {
        margin-left: 0 !important;
        padding: 20px;
      }

      .profile-section {
        flex-direction: column;
        text-align: center;
      }

      .organizer-photo {
        margin: 0 0 20px 0;
      }

      .dropdown-btn {
        font-size: 0.95rem;
      }
    }

    .profile-section {
      display: flex;
      align-items: center;
      background: white;
      padding: 25px 30px;
      border-radius: 14px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      transition: all 0.3s ease;
    }

    .organizer-photo {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #dcdcdcff;
      margin-right: 25px;
    }

    .profile-info {
      flex: 1;
    }

    .organizer-name {
      font-size: 1.8rem;
      color: #2e3a59;
      margin-bottom: 8px;
    }

    .organizer-desc {
      color: #555;
      margin-bottom: 10px;
      line-height: 1.5;
    }

    .social-link {
      color: #888;
      font-weight: bold;
      text-decoration: none;
    }

    .social-link:hover {
      text-decoration: underline;
    }

    .edit-profile-btn {
      display: inline-block;
      padding: 8px 16px;
      background-color: #1e90ff;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .edit-profile-btn:hover {
      background-color: #0c6ad8;
    }

    .dropdown-btn {
      background: #5fafffff;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: bold;
      width: 100%;
      text-align: left;
      margin-bottom: 15px;
      transition: background 0.3s ease;
    }

    .dropdown-btn:hover {
      background: #3b8fe2ff;
    }

    .dropdown-content {
      display: none;
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    }

    .dropdown-event-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
      transition: background 0.2s ease;
    }

    .dropdown-event-card:last-child {
      border-bottom: none;
    }

    .dropdown-event-card:hover {
      background-color: #f9f9f9;
    }

    .event-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .event-thumb {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      object-fit: cover;
      border: 2px solid #ccc;
    }

    .ta-btn {
      padding: 8px 14px;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .ta-btn.blue {
      background-color: #1e90ff;
      color: white;
    }

    .ta-btn.blue:hover {
      background-color: #0c6ad8;
    }

    .no-event {
      color: #888;
      text-align: center;
      padding: 10px;
      font-style: italic;
    }

    @media (max-width: 768px) {
      .profile-section {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .organizer-photo {
        margin: 0 auto 15px auto;
        transform: translateX(-2px);
      }

      .profile-info {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .edit-profile-btn {
        margin-top: 15px;
      }
    }

    @media (min-width: 769px) {
      .sidebar.desktop-closed {
        transform: translateX(-100%);
      }

      .main-content.collapsed {
        margin-left: 0;
      }

      .dropdown-section.collapsed {
        margin-left: 0;
      }
    }

    .hamburger-btn {
      color: #2e4a59;
    }

    @media (min-width: 769px) {
      .sidebar.desktop-closed ~ .hamburger-btn {
        color: #fff;
      }
    }

    @media (max-width: 768px) {
      .hamburger-btn.active {
        color: #fff;
      }
    }

    .title-event {
      color: #2e3a59;
      margin-bottom: 6px;
    }

    .status-event {
      color: #888;
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
    <div class="profile-section">
      <img
        src="{{ $user->profile_picture_url }}"
        alt="Profile Image"
        class="organizer-photo"
      />
      <div class="profile-info">
        <h1 class="organizer-name">{{ $user->name }}</h1>
        <p class="organizer-desc">{{ $user->description ?? 'No description added yet' }}</p>

        @if ($user->social_link)
          <p><a href="{{ $user->social_link }}" target="_blank" class="social-link">Visit Social Profile</a></p>
        @endif

        <a href="{{ route('organizer.editprofile') }}" class="edit-profile-btn">Edit Profile</a>
      </div>
    </div>
  </div>

  <div class="dropdown-section">
    <button id="dropdownToggle" class="dropdown-btn">Transaction & Attendance</button>
    <div id="dropdownContent" class="dropdown-content">
      @php
        $publishedEvents = $events->filter(fn($e) => $e->status === 'published');
      @endphp

      @forelse ($publishedEvents as $event)
        <div class="dropdown-event-card">
          <div class="event-left">
            <img
              src="{{ 
                    $event->image_path && file_exists(public_path($event->image_path))
                      ? asset($event->image_path)
                      : asset('images/defaults.png')
                  }}"
              alt="Event Image"
              class="event-thumb"
            />
            <div>
              <h3 class="title-event">{{ $event->title }}</h3>
              <p class="status-event">Status: {{ ucfirst($event->status) }}</p>
            </div>
          </div>
          <div class="event-right">
            <a href="{{ route('organizer.transactionattendance', ['event' => $event->id]) }}" class="ta-btn blue">View</a>
          </div>
        </div>
      @empty
        <p class="no-events">No published events yet.</p>
      @endforelse
    </div>
  </div>


  <script>
      const sidebar = document.getElementById("sidebar");
      const hamburgerBtn = document.getElementById("hamburgerbtn");
      const closeSidebarBtn = document.getElementById("closeSidebarBtn");
      const mainContent = document.getElementById("main-content");
      const dropdownSection = document.querySelector(".dropdown-section");
      const dropdownToggle = document.getElementById("dropdownToggle");
      const dropdownContent = document.getElementById("dropdownContent");

      function isMobileView() {
        return window.innerWidth <= 768;
      }

      function updateHamburgerColor() {
        if (isMobileView()) {
          hamburgerBtn.classList.toggle("active", sidebar.classList.contains("active"));
        } else {
          if (sidebar.classList.contains("desktop-closed")) {
            hamburgerBtn.style.color = '#2e4a59';
          } else {
            hamburgerBtn.style.color = '#fff';
          }
        }
      }

      function closeSidebarDesktop() {
        sidebar.classList.add("desktop-closed");
        mainContent.classList.add("collapsed");
        dropdownSection.classList.add("collapsed");
        updateHamburgerColor();
      }

      function openSidebarDesktop() {
        sidebar.classList.remove("desktop-closed");
        mainContent.classList.remove("collapsed");
        dropdownSection.classList.remove("collapsed");
        updateHamburgerColor();
      }

      hamburgerBtn.addEventListener("click", (e) => {
        e.stopPropagation();

        if (isMobileView()) {
          sidebar.classList.toggle("active");
        } else {
          if (sidebar.classList.contains("desktop-closed")) {
            openSidebarDesktop();
          } else {
            closeSidebarDesktop();
          }
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

      dropdownToggle.addEventListener("click", () => {
        dropdownContent.style.display =
          dropdownContent.style.display === "block" ? "none" : "block";
      });

      window.addEventListener("resize", () => {
        if (isMobileView()) {
          sidebar.classList.remove("desktop-closed");
          sidebar.classList.remove("active");
          mainContent.classList.remove("collapsed");
          dropdownSection.classList.remove("collapsed");
        }
        updateHamburgerColor();
      });

      updateHamburgerColor();
  </script>
</body>
</html>
