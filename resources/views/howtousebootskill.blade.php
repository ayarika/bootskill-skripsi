<!DOCTYPE html>
<html lang= "en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>How To Use Boot Skill</title>

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #333;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 10px;
            background: transparent;
            border: none;
            z-index: 1001;
            color: white;
        }

        .hamburger-btn.active {
            color: #2e3a59;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 170px;
            height: 100vh;
            transform: translateX(0);
            transition: transform 0.3s ease;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar h3 {
            color: white;
            margin-top: 60px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 0 20px;
            color: white;
            text-decoration: none;
            position: relative;
            transition: background 0.2s ease, padding-left 0.2s ease;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding-left: 8px;
            transition: all 0.2s ease;
        }

        .footer-nav {
            margin-top: 145.5px;
            padding-top: 28px;
        }

        .footer-nav a {
            color: white;
            font-size: 11.5px;
            margin-top: 4px;
            text-decoration: none;
            padding: 4px 0;
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .footer-nav .link-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 3px;
        }

        .footer-nav a:hover {
            color: #4fc3f7;
            background: none;
            border-radius: 0;
        }

        .footer-nav a[href="/aahowtousebootskill"] {
            padding-top: 3.6px;
            letter-spacing: 0.374px;
        }

        .footer-nav .copyright {
            padding-top: 1.5px;
            font-size: 10.5px;
            letter-spacing: 0.2px;
        }

        main {
            margin-left: 170px;
            padding: 40px 20px 20px 80px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background-color: #f9f9f9;
        }

        main.full {
            margin-left: 0;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #2e3a59;
            margin-bottom: 10px;
        }

        .page-subtitle {
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
            cursor: pointer;
        }

        .faq-question {
            font-size: 18px;
            font-weight: bold;
            color: #2e3a59;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question::after {
            content: "▼";
            font-size: 14px;
        }

        .faq-item.active .faq-question::after {
            content: "▲";
        }

        .faq-answer {
            display: none;
            margin-top: 12px;
            line-height: 1.6;
            color: #555;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-answe ul {
            padding-left: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <button id="hamburgerbtn" class="hamburger-btn" aria-label="Toggle menu">
        <svg width="30" height="30" viewBox="0 0 100 80" fill="currentColor" aria-hidden="true">
            <rect width="100" height="10"></rect>
            <rect y="30" width="100" height="10"></rect>
            <rect y="60" width="100" height="10"></rect>
        </svg>
    </button>

    <nav id="mainmenu" class="sidebar" aria-label="Main menu">
        <h3 style="color: white;">Boot Skill</h3>
        <a href="/aamainhome" style="color: white; font-weight: bold;">Home</a>
        <a href="/aayourcourse" style="color: white; font-weight: bold;">Your Course</a>
        <a href="/aamyschedule" style="color: white; font-weight: bold;">My Schedule</a>
        <a href="/aafavorite" style="color: white;  font-weight: bold;">Favorite</a>
        <a href="/settings" style="color: white; font-weight: bold;">Settings</a>

        <div class="footer-nav">
            <div class="link-row">
                <a href="/aaabout" style="color: white;">About</a>
                <a href="/contactus" style="color: white;">Contact Us</a>
            </div>
            <a href ="/aahowtousebootskill" style="color: white;">How To Use Boot Skill</a>
            <a class="copyright" style="color: white;">&copy; 2025 Boot Skill</a>
        </div>
    </nav>

    <main id="main-content" class="main-content">
        <h1 class="page-title">How To Use Boot Skill</h1>
        <p class="page-subtitle">A simple guide to help you use Boot Skill effectively.</p>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">Register and Sign In</div>
                <div class="faq-answer">
                    <p>Register and sign in to Boot Skill to access all features.</p>
                    <ul>
                        <li>Register using email or Google account</li>
                        <li>Sign in with email and password</li>
                        <li>Reset password if forgotten</li>
                        <li>Enjoy all features</li>
                    </ul>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">Choose Your Course</div>
                <div class="faq-answer">
                    <ul>
                        <li>Select your desired course</li>
                        <li>Search courses via search bar</li>
                        <li>Start learning after enrolling</li>
                        <li>View courses in "Your Course"</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Create Your Schedule</div>
                <div class="faq-answer">
                    <ul>
                        <li>Edit schedule from schedule menu</li>
                        <li>View on "My Schedule" page</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Enroll in a Bootcamp</div>
                <div class="faq-answer">
                    <ul>
                        <li>Click enroll on bootcamp page</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Evaluation Test</div>
                <div class="faq-answer">
                    <ul>
                        <li>Accessible if organizer enables it</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Group Link</div>
                <div class="faq-answer">
                    <ul>
                        <li>Join group if organizer provides link</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Change Role</div>
                <div class="faq-answer">
                    <ul>
                        <li>Change role at Switch to Organizer</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    
   <script>
        const toggleBtn = document.getElementById('hamburgerbtn');
        const sidebar = document.getElementById('mainmenu');
        const main = document.querySelector('main');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            main.classList.toggle('full');
            toggleBtn.classList.toggle('active');
        });

        document.querySelectorAll(".faq-item").forEach(item => {
            item.addEventListener("click", () => {
                item.classList.toggle("active");
            });
        });
    </script>
</body>
</html>