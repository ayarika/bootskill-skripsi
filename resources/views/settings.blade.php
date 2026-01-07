<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .settings-wrapper {
            display: flex;
            height: 100vh;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 15px;
            background: none;
            border: none;
            z-index: 1100;
            cursor: pointer;
        }

        #settings-container {
            margin-left: 250spx;
            padding: 30px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        .hamburger-btn .bar {
            fill: #2e3a59; 
            transition: fill 0.3s ease;
        }

        .hamburger-btn.active .bar {
            fill: white; 
        }


        .hamburger-icon .bar {
            fill: #2e3a59;
        }

        .hamburger-btn svg {
            transition: fill 0.3s ease;
        }

        .hamburger-btn.active svg {
            fill: #fff;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 250px;
            height: 100vh;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 0;
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar-menu.open {
            transform: translateX(0);
        }

        .settings-container {
            margin-left: 0;
            padding: 30px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

       @media (max-width: 768px) {
            .sidebar-menu {
                width: 100vw;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1000;
            }

            .sidebar-menu.open {
                transform: translateX(0);
            }

            #settings-container {
                margin-left: 0 !important;
            }

            #settings-container.shifted {
                margin-left: 220px;
            }

            .hamburger-btn.active .bar {
                fill: white !important;
            }
        }

        .sidebar a {
            display: block;
            padding: 10px 0;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
            text-align: center;
            width: 100%;
            transition: background 0.2s;
        }

        .sidebar-profile {
            text-align: center;
            color: white;
            margin-bottom: 0;
            padding: 0 20px;
        }

        .sidebar-profile nav {
            display: flex;
            flex-direction: column;
            margin-top: 15px;
            gap: 10px;
            width: 100%;
        }

        .sidebar-profile img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar nav {
           display: flex;
            flex-direction: column;
            margin-top: 30px;
            padding: 0 20px;
            gap: 15px;
        }

        .sidebar-profile nav a {
            padding: 8px 0;
        }

        .sidebar a {
            display: block;
            padding: 10px 0;
            color: white;
            text-decoration: none;
            text-align: center;
            width: 100%;
            transition: background 0.2s;
        }

        .sidebar-profile p {
            margin: 0;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
        }

        #settings-container {
            margin-left: 0;
            padding: 30px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        #settings-container.shifted {
            margin-left: 220px;
        }

        main.content {
            max-width: 800px;
            margin: 0 auto;
        }

        .tab-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .tab-content h2 {
            margin-bottom: 20px;
            color: #2e3a59;
        }

        .tab-content.active {
            display: block;
        }

        #notification {
            padding: 25px 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        #notification h2 {
            font-size: 22px;
            color: #2e3a59;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        #notification .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            padding: 12px 15px;
            background-color: #f1f4f9;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        #notification .notification-item:hover {
            background-color: #e3e9f2;
        }

        #notification .notification-item label {
            display: flex;
            align-items: center;
            font-size: 15px;
            color: #333;
            cursor: pointer;
            width: 100%;
        }

        #notification .notification-item input[type="checkbox"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
            accent-color: #2e3a59;
        }

        #notification button {
            margin-top: 20px;
            background-color: #2e3a59;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #notification button:hover {
            background-color: #1c2740;
        }


        #notification form label {
            display: block;
            margin-bottom: 15px;
            font-size: 15px;
            color: #333;
        }

        #notification input[type="checkbox"] {
            margin-right: 10px;
            accent-color: #2e3a59;
        }
        
        #notification button {
            background-color: #2e3a59;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #notification button:hover {
            background-color: #1c2740;
        }

        #help ul {
            padding-left: 20px;
            line-height: 1.8;
        }

        #help li {
            color: #444;
        }

        #help a {
            color: #2e3a59;
            text-decoration: underline;
            transition: color 0.2s ease;
        }

        #help a:hover {
            color: #1c2740;
        }

        .hidden {
            display: none !important;
        }

        .settings-tab.active {
            font-weight: bold;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-top: 20px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 6px;
            margin-top: 5px;
        }

        form input[type="file"] {
            margin-top: 10px;
        }

        .content {
            padding: 30px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            min-height: 100vh;
        }


        form button[type="submit"] {
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #2779bd;
        }

        .delete-account-btn {
            margin-top: 15px;
            background-color: #e63946;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .delete-account-btn:hover {
            background-color: #c71f30;
        }

        .delete-account-btn:active {
            transform: scale(0.97);
        }

        .delete-account-wrapper {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .popup-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 380px;
            background: #fff;
            padding: 26px 30px;
            border-radius: 14px;
            box-shadow: 0 15px 42px rgba(0,0,0,0.19);
            z-index: 9999;
            display: none;
            animation: panelFade 0.25s ease-out;
            text-align: center;
        }

        .popup-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            width: 100%;
            margin-top: 10px;
        }

        .popup-actions button,
        .popup-actions .btn-delete,
        .popup-actions .btn-cancel {
            width: 120px;
            height: 44px;
            padding: 0 !important;
            line-height: 44px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.25s ease, transform 0.1s ease;
        }

        .btn-cancel {
            background: transparent !important;
            border: 1px solid #aaa !important;
            color: #333 !important;
        }

        .btn-cancel:hover {
            background: rgba(0,0,0,0.6);
        }

        .btn-cancel:active {
            transform: scale(0.97);
        }

        .btn-delete {
            background: #e63946 !important;
            color: #fff;
        }

        .btn-delete:hover {
            background: #c71f30 !important;
        }

        .btn-delete:active {
            transform: scale(0.97);
        }

        .popup-actions form {
            margin: 0;
            padding: 0;
            display: flex;
        }

        .popup-actions form {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
            line-height: 0;
        }

        .popup-actions form button {
            margin: 0 !important;
        }

        .sidebar-profile img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.7);
            margin-bottom: 10px;
        }
        
        #previewImage {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            margin-bottom: 10px;
        }

        .sidebar-profile img:hover,
        #previewImage:hover {
            transform: scale(1.03);
            transition: 0.2s ease;
        }

        @media (max-width: 768px) {
            .sidebar-profile img {
                width: 70px;
                height: 70px;
            }

            #previewImage {
                width: 100px;
                height: 100px;
            }
        }

    </style>
</head>
<body>

    <div class="settings-wrapper" id="settingsWrapper">
            <button id="hamburgerbtn" class="hamburger-btn">
                <svg class="hamburger-icon" width="30" height="30" viewBox="0 0 100 80" aria-hidden="true">
                    <rect class="bar" width="100" height="10"></rect>
                    <rect class="bar" y="30" width="100" height="10"></rect>
                    <rect class="bar" y="60" width="100" height="10"></rect>
                </svg>
            </button>


        <div class="sidebar-menu" id="sidebar-menu">
            <div class="sidebar-profile">
                @php
                    $profileSrc = $user->profile_picture
                        ? asset($user->profile_picture)
                        : asset('images/default-profile.jpg');
                @endphp
                <img
                    src="{{ $profileSrc }}"
                    alt="Profile Picture"
                    onerror="this.onerror=null;this.src='{{ asset('images/default-profile.jpg') }}';"
                >

                <p>{{ $user->name }}</p>
                <p style="font-size: 0.9em; color: white;">{{ $user->email }}</p>

                <nav class="sidebar" style="color: #2e3a59;">
                    <a href="#" class="settings-tab active" data-tab="profile">Profile</a>
                    <a href="#" class="settings-tab" data-tab="help">Help</a>
                    <a href="/aamainhome">Home</a>
                    <a href="/logout">Log Out</a>
                </nav>
            </div>
        </div>

        <div id="settings-container">
            <main class="content">
                <div class="tab-content active" id="profile">
                    <h2>Profile Settings</h2>

                    @if(session('success'))
                        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div style="color: red; margin-bottom: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>

                            <label>Change Profile Picture</label><br>

                            <img 
                                id="previewImage"
                                src="{{ $profileSrc }}"
                                data-default="{{ asset('images/default-profile.jpg') }}"
                                alt="Profile"
                                onerror="this.onerror=null;this.src='{{ asset('images/default-profile.jpg') }}';"
                            >

                            <br>
                            <input type="file" name="profile_picture" id="profile_picture" accept=".jpg,.jpeg,.png" onchange="validateAndPreview(event)">
                            <small id="fileError" style="color: red;"></small>
                        </div>


                        {{-- Name --}}
                        <label>Name</label><br>
                        <input type="text" name="name" value="{{ $user->name }}"><br><br>

                        {{-- Email --}}
                        <label>Email</label><br>
                        <input type="email" name="email" value="{{ $user->email }}"><br><br>

                        {{-- Password --}}
                        <label>New Password (leave blank if unchanged)</label><br>
                        <input type="password" name="password"><br><br>

                        {{-- Submit --}}
                        <button type="submit">Update Profile</button>

                        <button type="button" onclick="openPanel()" class="delete-account-btn">
                            Delete Account
                        </button>
                    </form>

                </div>

                <div class="tab-content hidden" id="help">
                    <h2>Help & Support</h2>
                    <p>If you have questions or need assistance, you can contact us at:</p>
                    <ul>
                        <li>Email: support@bootskill.com</li>
                        <li>Phone: +62 812 3456 7890</li>
                    </ul>
                    <p>You can also visit our <a href="/aahowtousebootskill" style="text-decoration: none; font-weight: bold; color: #2e3a59;">guide page</a> to learn how to use Boot Skill.</p>
                </div>
            </main>
        </div>
    </div>

    <div id="deletePanel" class="popup-panel">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete your account?<br>This action cannot be undone.</p>

        <div class="popup-actions">
            <button class="btn-cancel" onclick="closePanel()">Cancel</button>

            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>
    </div>

    @if(session('active_tab'))
        <script>
            localStorage.setItem("activeTab", "{{ session('active_tab') }}");
        </script>
    @endif

    <script>
            document.addEventListener('DOMContentLoaded', function () {
                const hamburgerBtn = document.querySelector('.hamburger-btn');
                const sidebar = document.querySelector('.sidebar-menu');
                const content = document.querySelector('#settings-container');

                hamburgerBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('open');
                    content.classList.toggle('shifted');
                    hamburgerBtn.classList.toggle('active');
                });   
            });

            document.addEventListener("DOMContentLoaded", function () {
                const tabLinks = document.querySelectorAll(".settings-tab");
                const tabContents = document.querySelectorAll(".tab-content");

                const savedTab = localStorage.getItem("activeTab");
                if (savedTab) {
                    tabContents.forEach(content => {
                        content.classList.add("hidden");
                        content.classList.remove("active");
                    });

                    const targetContent = document.getElementById(savedTab);
                    if (targetContent) {
                        targetContent.classList.remove("hidden");
                        targetContent.classList.add("active");
                    }

                    tabLinks.forEach(link => {
                        if (link.getAttribute("data-tab") === savedTab) {
                            link.classList.add("active");
                        } else {
                            link.classList.remove("active");
                        }
                    });
                }

                        tabLinks.forEach(link => {
                            link.addEventListener("click", function (e) {
                                e.preventDefault();

                        const target = this.getAttribute("data-tab");

                        tabLinks.forEach(link => link.classList.remove("active"));
                        tabContents.forEach(content => {
                            content.classList.add("hidden");
                            content.classList.remove("active");
                        });

                        const targetContent = document.getElementById(target);
                        if (targetContent) {
                            targetContent.classList.remove("hidden");
                            targetContent.classList.add("active");
                        }

                        this.classList.add("active");

                        // Simpan tab aktif
                        localStorage.setItem("activeTab", target);
                    });
                });
            });
            
            function validateAndPreview(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('previewImage');
                const error = document.getElementById('fileError');
                const defaultSrc = preview.getAttribute('data-default');

                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!allowedTypes.includes(file.type)) {
                        error.textContent = 'Only JPG, JPEG, or PNG files are allowed.';
                        preview.src = defaultSrc;
                        return;
                    }

                    error.textContent = '';
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }

            function openPanel() {
                document.getElementById('deletePanel').style.display = 'block';
            }

            function closePanel() {
                document.getElementById('deletePanel').style.display = 'none';
            }
    </script>
</body>
</html>