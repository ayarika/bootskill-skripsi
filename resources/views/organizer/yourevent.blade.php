<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Event</title>
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
      padding: 80px 30px 40px 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
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

      .main-content {
        margin-left: 0 !important;
        padding: 20px;
      }
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .create-btn {
      padding: 10px 20px;
      background-color: #1e90ff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
    }

    .create-btn:hover {
      background-color: #0c6ad8;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .event-card {
      background-color: #fff;
      border-radius: 12px;
      padding: 16px;
      box-shadow: 0 2px 8px rgba(0, 0, 0,  0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .event-title {
      font-size: 18px;
      font-weight: 600;
      color: #2e3a59;
      text-transform: uppercase;
      text-align: left;
      line-height: 1.3;
      margin-top: 5px;
      margin-bottom: 6px;
    }

    .status {
      font-size: 12px;
      color: #888;
      opacity: 0.85;
      margin: 0;
      line-height: 1.2;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .event-image {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }

    .event-content {
      padding: 10px 14px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
      gap: 2px;
    }

    .action-buttons {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 12px;
    }

    .action-buttons a,
    .action-buttons button {
      padding: 10px 0;
      border-radius: 6px;
      text-align: center;
      font-size: 14px;
      font-weight: 600;

      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .edit-btn { 
      background-color: #e0e0e0;
      color: #2e3a59;
      font-weight: 600;
    }

    .edit-btn:hover {
      background-color: #d5d5d5;
      color: #2e3a59;
    }
    .delete-btn { 
      background-color: #e74c3c;
      color: #fff;
      border: none; 
      text-decoration: none;
    }

    .delete-btn:hover {
      background-color: #c0392b;
    }

    .ta-btn { 
      background-color: #28a745; 
    }

    .action-buttons form {
      display: inline;
    }

    @media (min-width: 769px) {
      .sidebar.desktop-closed {
        transform: translateX(-100%);
      }

      .main-content.collapsed {
        margin-left: 0;
      }
    }

    .hamburger-btn {
      transition: color 0.3s ease;
    }

    @media (max-width: 768px) {
      .hamburger-btn.active {
        color: #fff;
      }
    }

    .title-events {
      color: #2e3a59;
    }

    .action-btn {
      height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }

    .event-card {
      padding-bottom: 18px;
    }

    @media (max-width: 480px) {
      .action-buttons{
        grid-template-columns: 1fr;
      }
    }

    .action-buttons form {
      width: 100%;
    }

    .action-buttons form button {
      width: 100%;
    }

    .action-buttons a,
    .action-buttons button {
      width: 100%;
      height: 40px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0 !important;
        padding: 70px 20px 20px 20px;
      }
    }

    .delete-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.95);
      background: #fff;
      border-radius: 14px;

      width: 92%;
      max-width: 420px;

      padding: 26px 24px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.25);
      z-index: 5000;
      display: none;
      opacity: 0;
      transition: all 0.2s ease;
      text-align: center;

    }

    .delete-popup.active {
      display: block;
      opacity: 1;
      transform: translate(-50%, -50%) scale(1);
    }

    .delete-popup h3 {
      margin-bottom: 8px;
      color: #2e3a59;
      font-size: 20px;
      text-align: center;
    }

    .delete-popup p {
      font-size: 15px;
      color: #555;
      line-height: 1.5;
      margin-top: 6px;
      text-align: center;
    }

    .delete-actions {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 18px;
    }

    .popup-cancel {
      background: #e0e0e0;
      border: none;
      padding: 7px 14px;
      border-radius: 6px;
      cursor: pointer;
      color: #2e3a59;
    }

    .popup-cancel:hover {
      background: #d5d5d5;
    }

    .popup-confirm {
      background: #e74c3c;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;
      cursor: pointer;
    }

    .popup-confirm:hover {
      background: #c0392b;
    }
    
    @media (min-width: 768px) {
      .delete-popup {
        max-width: 460px;
      }
    }

    .popup-cancel,
    .popup-confirm {
      min-width: 110px;
      padding: 10px 18px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
    }

    @media (max-width: 480px) {
      .delete-actions {
        flex-direction: column;
      }

      .popup-cancel,
      .popup-confirm {
        width: 100%;
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

  <div class="main-content" id="main-content">
    <div class="header">
      <h2 class="title-events">Your Events</h2>
      <a href="{{ route('organizer.createevent') }}" class="create-btn">+ Create Event</a>
    </div>

    <div class="grid-container">
      @forelse ($events as $event)
        <div class="event-card">
            <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('images/defaults.png') }}"
              alt="Event Image" class="event-image">
            
            <div class="event-content">
              <div class="event-title">{{ $event->title }}</div>
              <div class="status">Status: {{ ucfirst($event->status) }}</div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('organizer.editevent', $event->id) }}" class="action-btn edit-btn">Edit</a>

                <form method="POST" action="{{ route('organizer.deleteevent', $event->id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="action-btn delete-btn"
                        data-event-title="{{ $event->title }}"
                        onclick="openDeleteModal(this)">
                        Delete
                </form>
            </div>
        </div>
      @empty
        <p>No events found.</p>
      @endforelse
    </div>

        <div id="deleteModal" class="delete-popup">
          <h3>Delete Event</h3>
          <p id="deleteMessage">
            Are you sure you want to delete this event?
          </p>

          <div class="delete-actions">
            <button class="popup-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="popup-confirm" onclick="confirmDelete()">Delete</button>
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
          hamburgerBtn.style.color = "";
        } else {
          hamburgerBtn.classList.remove("active");

          if (sidebar.classList.contains("desktop-closed")) {
            hamburgerBtn.style.color = "#2e4a59";
          } else {
            hamburgerBtn.style.color = "#fff";
          }
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
          sidebar.classList.contains("desktop-closed") ? openSidebarDesktop() : closeSidebarDesktop();
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


      let deleteForm = null;
      
      function openDeleteModal(button) {
        deleteForm = button.closest("form");

        const title = button.dataset.eventTitle;

        document.getElementById("deleteMessage").innerHTML = `
          Are you sure you want to delete "<strong>${title}</strong>"?<br>
          <span style="color: #555; font-weight:600;">
            This action cannot be undone.
          </span>
        `;

        document.getElementById("deleteModal").classList.add("active");
      }

      function closeDeleteModal() {
        document.getElementById("deleteModal").classList.remove("active");
        deleteForm = null;
      }

      function confirmDelete() {
        if (deleteForm) {
          deleteForm.submit();
        }
      }

      document.addEventListener("click", function (e) {
        const modal = document.getElementById("deleteModal");
        if (modal.classList.contains("active") && !modal.contains(e.target) && !e.target.classList.contains("delete-btn")){
          closeDeleteModal();
        }
      });

  </script>
</body>
</html>
