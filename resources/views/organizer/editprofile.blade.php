<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            padding-top: 60px;
            transition: transform 0.3s ease, width 0.3s ease;
            z-index: 1000;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            transition: all 0.2s ease;
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
        }

        .main-content {
            margin-left: 200px;
            padding: 40px 30px;
            transition: margin-left 0.3s ease;
        }


        .form-container {
            transition: all 0.3s ease;
        }

        .edit-profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0, 0.1);
            max-width: 700px;
            margin: auto;
            transition: all 0.3s ease;
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
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

        .logo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 15px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="url"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            height: 100px;
        }

        .form-group img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .btn-submit {
            padding: 12px 24px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0c6ad8;
        }

        .btn-account {
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #e0e0e0;
            color: #2e3a59;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-account:hover {
            background-color: #d5d5d5;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 5000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 25px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -45%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .account-options-row {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .account-options-row form,
        .account-options-row button {
            width: 100%;
        }

        .account-options-row button {
            width: 100%;
            padding: 12px 0;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn-account-blue {
            background-color: #3a6ed8;
            color: white;
            padding: 10px 18px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-account-blue:hover {
            background-color: #2e57ad;
        }

        .btn-account-green {
            background-color: #4CAF50;
            color: white;
            padding: 10px 18px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-account-green:hover {
            background-color: #419744ff;
        }

        .btn-delete {
            background-color: #d62839;
            color: white;
            padding: 10px 18px;
            border: none;
        }

        .btn-delete:hover {
            background-color: #b61f30;
        }

        #passwordModal .modal-content {
            background: linear-gradient(145deg, #fff, #f1f4f9);
            border-radius: 14px;
            padding: 30px 25px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            max-width: 420px;
            width: 90%;
            text-align: left;
            animation: slideUp 0.35s ease;
        }

        #passwordModal h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #2e3a59;
        }

        #passwordModal .form-group {
            margin-bottom: 18px;
        }

        #passwordModal label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #2e3a59;
            font-weight: 600;
        }

        #passwordModal input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccd1e4;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafbff;
            transition: all 0.2s ease;
        }

        #passwordModal input[type="password"]:focus {
            border-color: #4b6cb7;
            outline: none;
            box-shadow: 0 0 0 2px rgba(75, 108, 183, 0.2);
        }

        #passwordModal .btn-submit {
            width: 100%;
            background-color: #1e90ff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        #passwordModal .btn-submit:hover {
            background-color: #0c6ad8;
        }

        #passwordModal .close {
            color: #999;
            font-size: 26px;
            position: absolute;
            top: 10px;
            right: 18px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        #passwordModal .close:hover {
            color: #000;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @media (max-width: 480px) {
            #passwordModal .modal-content {
                padding: 25px 18px;
                width: 92%;
            }

            #passwordModal h3 {
                font-size: 18px;
            }

            #passwordModal input[type="password"] {
                font-size: 13px;
                padding: 8px;
            }

            #passwordModal .btn-submit {
                font-size: 14px;
                padding: 10px;
            }
        }

        #accountPanel .modal-content {
            background: #fff;
            border-radius: 18px;
            padding: 32px 28px;
            width: 420px;
            text-align: center;
            box-shadow: 0 12px 28px rgba(0,0,0,0.18);
            animation: modalZoom 0.35s ease;
        }

        #accountPanel h3 {
            font-size: 22px;
            font-weight: 700;
            color: #2e3a59;
            margin-bottom: 6px;
        }

        #accountPanel p {
            font-size: 14px;
            color: #555;
            margin-bottom: 25px;
        }

        #accountPanel .close {
            color: #888;
            font-size: 24px;
            position: absolute;
            right: 18px;
            top: 12px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        #accountPanel .close:hover {
            color: #000;
        }

        .account-options-row {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .account-options-row button,
        .account-options-row form button {
            width: 100%;
            padding: 12px 0;
            border-radius: 10px;
            font-size: 15px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .btn-account-blue {
            background-color: #fff;
            color: #2e3a59;
            border: 2px solid #3b6ed8;
        }

        .btn-account-blue:hover {
            background-color: #e8e5e5ff;
        }

        .btn-account-green {
            background-color: #fff;
            color: #2e3a59;
            border: 2px solid #3b6ed8;
        }
        
        .btn-account-green:hover {
            background-color: #e8e5e5ff;
        }

        .btn-delete {
            background-color: #d62839;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #b61f30;
        }

        @keyframes modalZoom {
            from {
                opacity: 0;
                transition: scale(0.9) translateY(-10px);
            }
            to {
                opacity: 1;
                transition: scale(1) translateY(0);
            }
        }

        @media (max-width: 480px) {
            #accountPanel .modal-content {
                padding: 26px 20px;
            }

            #accountPanel h3 {
                font-size: 20px;
            }
        }

        .account-options-row .btn-account-blue,
        .account-options-row .btn-account-green {
            border: 2px solid #eaedf1ff !important;
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
            box-shadow: 0 15px 42px rgba(0,0,0,0.15);
            z-index: 9999;
            display: none;
            animation: popupFade 0.25s ease-out;
            text-align: center;
        }

        .popup-panel h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2e3a59;
            font-weight: 700;
        }

        .popup-panel p {
            font-size: 15px;
            color: #555;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .popup-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
        }

        .btn-cancel,
        .btn-delete {
            min-width: 120px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-cancel {
            background: #e5e5e5;
            color: #333;
        }

        .btn-cancel:hover {
            background: #d6d6d6;
        }

        .btn-delete {
            background: #d62839;
            color: #fff;
        }

        .btn-delete:hover {
            background: #b61f30;
        }

        @keyframes popupFade {
            from {
                opacity: 0;
                transform: translate(-50%, -55%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @media (max-width: 480px) {
            .popup-panel {
                width: 90%;
                padding: 22px 20px;
            }

            .popup-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-delete {
                width: 100%;
                height: 44px;
            }
        }

        .switch-role-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 16px;
            align-self: stretch;
        }

        .switch-btn {
            min-width: 160px;
            background-color: #1e90ff;
            color: white;
        }
        
        .switch-btn:hover {
            background-color: #0c6ad8;
        }

        @media (max-width: 480px) {
            .switch-role-wrapper {
                justify-content: center;
            }
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
            color: #2e4a59;
            transition: color 0.3s ease;
        }

        @media (max-width: 768px) {
            .hamburger-btn.active {
                color: #fff;
            }
        }

        .prof-op {
            color: #2e3a59;
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

        .organizer-profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            margin-bottom: 10px;
        }

        .hamburger-btn {
            color: #2e4a59;
        }

        .hamburger-btn.active {
           color: #fff;
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
        <div class="form-container">
            <div class="edit-profile-container">

                <div class="switch-role-wrapper">
                    <form id="switchRoleForm" action="{{ route ('switch.role') }}" method="POST" style="margin-bottom: 16px;">
                        @csrf
                        <button type="button" id="openSwitchPopup" class="btn-account switch-btn">
                            Switch to {{ auth()->user()->role === 'organizer_active' ? 'Participant' : 'Organizer' }}
                        </button>
                    </form>
                </div>

                <form action="/organizer/update-profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="photo" class="prof-op">Profile Picture</label>

                        <img id="previewImage"
                            src="{{ $user->profile_picture && file_exists(public_path($user->profile_picture))
                                ? asset('$user->profile_picture)
                                : asset('images/default-profile.jpg') }}"
                            alt="Profile Picture"
                            class="organizer-profile-img"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-profile.jpg') }}';"
                        >

                        <br>

                        @if ($user->profile_picture)
                            <button type="button" id="removePhotoBtn" 
                                style="`margin-bottom: 10px;
                                        background: #d62839;
                                        border: none;
                                        color: white;
                                        padding: 6px 10px;
                                        border-radius: 6px;
                                        cursor: pointer;">
                                Remove Photo
                            </button>
                        @endif

                        <input type="file" name="profile_picture" id="profile_picture">
                    </div>
                    <div class="form-group">
                        <label for="name" class="prof-op">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="prof-op">Description</label>
                        <textarea name="description" id="description">{{ old('description', $user->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="social" class="prof-op">Social Media</label>
                        <input type="url" name="social_link" id="social_link" value="{{ old('social_link', $user->social_link) }}">
                    </div>

                    <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                    <button type="submit" class="btn-submit">Update</button>

                </form>

                <div id="switchPopup" class="popup-panel">
                    <div class="popup-content">
                        <h2>Switch Role</h2>
                        <p>
                            Are you sure you want to switch to 
                            <strong>
                                {{ auth()->user()->role === 'organizer_active' ? 'Participant' : 'Organizer' }}
                            </strong>
                            <br>
                            Your dashboard and features will change.
                        </p>

                        <div class="popup-actions">
                            <button type="button" class="btn-cancel" id="cancelSwitch">Cancel</button>
                            <button type="button" class="btn-delete" id="confirmSwitch">Yes, Switch</button>
                        </div>
                    </div>
                </div>
         
                <button type="button" class="btn-account" id="openAccountPanel">
                    Account Settings
                </button>

                <div id="accountPanel" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h3>Account Options</h3>
                        <p>Manage your account safely:</p>

                        <div class="account-options-row">
                            <form action="{{ route('switchaccount.form') }}" method="GET">
                                <button type="submit" class="btn-account-blue">Switch Account</button>
                            </form>

                            <button type="button" class="btn-account-green" id="openPasswordModal">Change Password</button>

                            <form action="{{ route('organizer.deleteAccount') }}" method="POST" onsubmit="return confirm('This will permanently delete your account. Continue?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete Account</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="passwordModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closePasswordModal">&times;</span>
                        <h3>Change Password</h3>
                        <form action="{{ route('password.change') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn-submit" style="width: 100%;">Update Password</button>
                        </form>
                    </div>
                </div>
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
            hamburgerBtn.classList.toggle(
                "active",
                isMobileView()
                    ? sidebar.classList.contains("active")
                    : !sidebar.classList.contains("desktop-closed")
            );
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

            if(isMobileView()) {
                sidebar.classList.toggle("active");
            } else {
                sidebar.classList.contains("desktop-closed")
                    ? openSidebarDesktop()
                    : closeSidebarDesktop();
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

        closeSidebarBtn.addEventListener("click", () => {
            if (isMobileView()) {
                sidebar.classList.remove("active");
            }
        });

        function handleRoleChange(select) {
            if (select.value === 'student') {
                window.location.href = "{{ route('aamainhome') }}";
            }
        }

        document.getElementById("profile_picture").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("previewImage");
            const removePhotoInput = document.getElementById("remove_photo");

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";
                removePhotoInput.value = "0";
            }
        });

        const removeBtn = document.getElementById("removePhotoBtn");
        if (removeBtn) {
            removeBtn.addEventListener("click", function ()  {
                const preview = document.getElementById("previewImage");
                const inputFile = document.getElementById("profile_picture");
                const removePhotoInput = document.getElementById("remove_photo");

                preview.src = "";
                preview.style.display = "none";
                inputFile.value = "";
                removePhotoInput.value = "1";
            });
        }

        const modal = document.getElementById("accountPanel");
        const openBtn = document.getElementById("openAccountPanel");
        const closeBtn = document.querySelector(".modal .close");

        openBtn.addEventListener("click", () => {
            modal.style.display = "block";
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        const passwordModal = document.getElementById("passwordModal");
        const openPasswordModal = document.getElementById("openPasswordModal");
        const closePasswordModal = document.getElementById("closePasswordModal");

        openPasswordModal.addEventListener("click", () => {
            passwordModal.style.display = "block";
        });

        closePasswordModal.addEventListener("click", () => {
            passwordModal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === passwordModal) {
                passwordModal.style.display = "none";
            }
        });


        const openSwitchBtn = document.getElementById('openSwitchPopup');
        const switchPopup = document.getElementById('switchPopup');
        const cancelSwitch = document.getElementById('cancelSwitch');
        const confirmSwitch = document.getElementById('confirmSwitch');
        const switchForm = document.getElementById('switchRoleForm');

        openSwitchBtn.addEventListener('click', () => {
            switchPopup.style.display = 'block';
        });

        cancelSwitch.addEventListener('click', () => {
            switchPopup.style.display = 'none';
        });

        confirmSwitch.addEventListener('click', () => {
            switchForm.submit();
        });

        window.addEventListener('click', (e) => {
            const popupContent = switchPopup.querySelector('.popup-content');
            if (switchPopup.style.display === 'block' && !popupContent.contains(e.target) && e.target != openSwitchBtn) {
                switchPopup.style.display = 'none';
            }
        });

        const passwordForm = document.querySelector("#passwordModal form");

        passwordForm.addEventListener("submit", function(e) {
            const newPassword = document.querySelector("#new_password").value;
            const confirmPassword = document.querySelector("#new_password_confirmation").value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();

                let existingError = document.getElementById("password-confirm-error");
                if(existingError) existingError.remove();

                const error = document.createElement("small");
                error.id = "password-confirm-error";
                error.className = "error-message";
                error.textContent = "Password do not match";
                error.style.color = "red";
                error.style.display = "block";
                error.style.marginTop = "4px";

                const confirmInput = document.querySelector("#new_password_confirmation");
                confirmInput.parentNode.appendChild(error);

                confirmInput.focus();
            }
        });
    </script>
</body>
</html>
