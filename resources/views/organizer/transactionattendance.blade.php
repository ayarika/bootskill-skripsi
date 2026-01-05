<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction and Attendance</title>
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
      transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                  width 0.45s cubic-bezier(0.4, 0, 0.2, 1);
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
      padding: 80px 30px 40px 30px;
      transition: margin-left 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                  padding-left 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .main-content.collapsed {
      margin-left: 0;
      padding-left: 30px !important;
      padding-top: 80px !important;
      transition: margin-left 0.45s cubic-bezier(0.4, 0, 0.2, 1),
                  padding-left 0.45s cubic-bezier(0.4, 0, 0.2, 1);
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

      .main-content.collapsed {
        padding-left: 20px !important;
        padding-top: 70px !important;
      }
    }

      .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        form div { 
            margin-bottom: 15px; 
        }

        label { 
            display: block; 
            font-weight: bold; 
            margin-bottom: 5px; 
        }

        table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 20px;
          background: white;
          box-shadow: 0 2px 6px rgba(0,0,0,0.1);
          border-radius: 8px;
          overflow: hidden;
        }

        table th,
        table td {
          padding: 12px 15px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }

        table th {
          background-color: #1e90ff;
          color: white;
          font-weight: normal;
        }

        table tbody tr:nth-child(even) {
          background-color: #f9f9f9;
        }

        .link {
          color: #1a73e8;
          text-decoration: underline;
        }

        .link:hover {
          color: #0f53c0;
        }

        .btn-success {
          display: inline-block;
          background-color: #4CAF50;
          color: white;
          padding: 10px 15px;
          text-decoration: none;
          border-radius: 5px;
          font-weight: bold;
        }

        .btn-success:hover {
          background-color: #45a049;
        }

        form {
          margin-top: 20px;
        }

        label {
          font-weight: bold;
          display: block;
          margin-bottom: 5px;
        }

        select {
          padding: 8px;
          width: 200px;
          border: 1px solid #ccc;
          border-radius: 4px;
        }

        .page-title {
          font-size: 32px;
          font-weight: 700;
          color: #2e3a59;
          margin-bottom: 15px;
          padding-bottom: 10px;
          z-index: 1;
        }

        .event-title {
          font-size: 24px;
          font-weight: 600;
          color: #555;
          margin-bottom: 20px;
        }

        .download-btn {
          display: inline-block;
          margin-bottom: 20px;
          padding: 10px 20px;
          text-decoration: none;
          transition: background-color 0.3s ease;
          background-color: #fff;
          color: #2e3a59;
          border: 2px solid #d8d4d4ff;
          font-weight: 600;
          opacity: 0.8;
        }

        .download-btn:hover {
          background: #d8d4d4ff;
        }

        @media (max-width: 768px) {
          .page-title {
            margin-top: 60px;
          }
        }

        @media (min-width: 1025px) {
          .sidebar {
            width: 200px;
          }

          .main-content {
            margin-left: 200px;
            transition: all 0.4s ease;
          }

          .page-title {
            margin-top: 10px;
            transition: all 0.4s ease;
          }
        }

        .filter-status {
          color: #2e3a59;
        }

        .desc-pop {
          color: #888;
        }

        .all-op {
          color: #555;
        }

        .action-bar {
          display: flex;
          align-items: center;
          gap: 16px;
          margin-bottom: 20px;
          flex-wrap: wrap;
        }

        .filter-form {
          display: flex;
          align-items: center;
          gap: 8px;
        }

        .filter-form labeL {
          margin-bottom: 0;
        }

        @media (max-width: 768px) {
          .action-bar {
            flex-direction: column;
            align-items: flex-start;
          }
        }

        .action-bar form {
          margin-top: 0;
        }

        .filter-form label,
        .action-bar label {
          display: inline-block;
          margin-bottom: 0;
        }

        .action-bar {
          align-items: center;
        }

        .filter-form {
          display: flex;
          align-items: center;
          gap: 8px;
        }

        .action-bar .download-btn {
          margin-bottom: 0;
        }

        .action-bar select,
        .action-bar .download-btn {
          height: 40px;
        }

        .action-bar form {
          margin: 0;
        }

        .action-bar {
          display: flex;
          justify-content: flex-start;
          align-items: center;
          width: 100%;
          margin-left: 0;
          margin-right: auto;
        }

        .action-bar > * {
          margin-left: 0;
        }

        @media (max-width: 768px) {
          .action-bar {
            flex-direction: row;
            align-items: flex-start;
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
    <h1 class="page-title">Transaction and Attendance</h1>

    @if ($event)
      <h2 class="event-title">{{ $event->title }}</h2>

      <table>
        <thead>
          <tr>
            <th>Participant Email</th>
            <th>Enroll Time</th>
            <th>Payment Proof</th>
            <th>Attendance Time</th>
            <th>Participant Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($event->enrolls as $enroll)
            <tr>
              <td>{{ $enroll->user->name }}</td>
              <td>{{ $enroll->created_at->timezone('Asia/Jakarta')->format('d M Y H:i')}}</td>
              <td>
                @if($event->price > 0)
                  @if ($enroll->payment_proof)
                    <a class="link" href="{{ route('organizer.paymentproof.show', $enroll->id) }}" target="_blank">receipt</a>
                  @else
                    File Not Found
                  @endif
                @else
                  Free
                @endif
              </td>
              <td>
                @if ($enroll->attendance_timestamp)
                  {{ \Carbon\Carbon::parse($enroll->attendance_timestamp)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                @else
                  Not Yet Attend
                @endif
              </td>
              <td>
                {!! $enroll->attendance_timestamp
                    ? '<span style="color: green;">Present</span>'
                    : '<span style="color: red;">Not Present</span>' !!}
                </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="desc-pop"> No participant for this event.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    @else
      <p>Event not been found.</p>
    @endif

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
          hamburgerBtn.classList.toggle(
            "active",
            sidebar.classList.contains("active")
          );
        } else {
          hamburgerBtn.classList.toggle(
            "active",
            !sidebar.classList.contains("collapsed")
          );
        }
      }

      hamburgerBtn.addEventListener("click", (e) => {
        e.stopPropagation();

        if (isMobileView()) {
          sidebar.classList.toggle("active");
        } else {
          sidebar.classList.toggle("collapsed");
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
          sidebar.classList.remove("collapsed");
          sidebar.classList.remove("active");
          mainContent.classList.remove("collapsed");
        }
        updateHamburgerColor();
      });

      updateHamburgerColor();
    </script>

</body>
</html>
