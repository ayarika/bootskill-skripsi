<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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
            left: 0;
            top: 0;
            height: 100vh;
            width: 170px;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a{
            display: block;
            padding: 10px 0 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding-left: 8px;
            transition: all 0.2s ease;
        }

        .footer-nav a:hover, .footer-nav a[href="/aahowtousebootskill"]:hover {
            background: none;
            border-radius: 0;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            margin-top: 60px;
        }

        main {
            margin-left: 170px;
            padding: 20px;
            padding-left: 80px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        main.full {
            margin-left: 0;
        }

        .topbarmain {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            height: 70px;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .footer-nav{
            margin-top: 180px;
            font-size: 0.85em;
            color: #666;
        }

        .footer-nav .link-row{
            display: flex;
            justify-content: flex-start;
            gap: 8px;
            margin-bottom: 4px;
        }

        .footer-nav a {
            text-decoration: none;
            color: #555;
            font-weight: normal;
            font-size: 0.85em;
            line-height: 1.2;
            display: inline-block;
            padding: 2px 0;
        }

        .footer-nav a[href="/aahowtousebootskill"]{
            display: block;
            margin-top: 2px;
            font-size: 0.9em;
            color: #555;
        }

        .footer-nav .block link {
            display: block;
            margin-bottom: 8px;
        }

        .footer-nav .copyright {
            font-size: 0.8em;
            color: #999;
            margin-top: 4px;
            display: block;
        }

        .contact-container {
            max-width: 600px;
            margin:auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0, 0.1);
        }

        .contact-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-container input,
        .contact-container textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-container button {
            background-color: #2e3a59;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-container button:hover {
            background-color: #1c253a;
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
        <a href="/aamainhome" style="color: white;">Home</a>
        <a href="/aayourcourse" style="color: white;">Your Course</a>
        <a href="/aamyschedule" style="color: white;">My Schedule</a>
        <a href="/aafavorite" style="color: white;">Favorite</a>
        <a href="/settings" style="color: white;">Settings</a>

        <div class="footer-nav">
            <div class="link-row">
                <a href="/aaabout" style="color: white;">About</a>
                <a href="/contactus" style="color: white;">Contact Us</a>
            </div>
            <a href="/aahowtousebootskill" style="color: white;">How To Use Boot Skill</a>
            <a class="copyright" style="color: white;">&copy; 2025 Boot Skill</a>
        </div>
    </nav>
    
    <main>
        <div class="contact-container">
            <h2 style="">Contact Us</h2>
            <p>If you have questions or need assistance, you can contact us at:</p>
                <ul>
                    <li>Email: support@bootskill.com</li>
                    <li>Phone: +62 812 3456 7890</li>
                </ul>
                <p>You can also visit our <a href="/aahowtousebootskill" style="text-decoration: none; font-weight: bold; color: #2e3a59;">guide page</a> to learn how to use Boot Skill.</p>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const sidebar = document.getElementById("mainmenu");
            const mainContent = document.querySelector("main");

            hamburgerBtn.addEventListener("click", function () {
                sidebar.classList.toggle("hidden");
                mainContent.classList.toggle("full");
                hamburgerBtn.classList.toggle("active");
            });
        });
    </script>

</body>