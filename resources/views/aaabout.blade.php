<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
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
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
            display: block;
            padding: 10px 0 20px;
            color: #ccc;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }

        .sidebar > a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding-left: 8px;
            transition: all 0.2s ease;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            margin-top: 60px;
            color: white;
        }

        .footer-nav {
            margin-top: 180px;
            font-size: 0.85em;
            color: #666;
        }

        .footer-nav .link-row {
            display: flex;
            justify-content: flex-start;
            gap : 8px;
            margin-bottom: 4px;
        }

        .footer-nav a {
            text-decoration: none;
            color: #aaa;
            font-weight: normal;
            font-size: 0.85em;
            display: inline-block;
            padding: 2px 0;
        }

        .footer-nav a[href="/aahowtousebootskill"] {
            display: block;
            margin-top: 2px;
            font-size: 0.9em;
            color: #aaa;
        }

        .footer-nav .copyright {
            font-size: 0.8em;
            color: #999;
            margin-top: 4px;
        }

        main,
        .about-container {
            margin-left: 170px;
            transition: margin-left 0.3s ease, transform 0.3s ease;
            padding: 80px 60px 60px 60px;
            box-sizing: border-box;
            max-width: 1000px;
            margin-right: auto;
        }

        main.full,
        .about-container.full {
            margin-left: 0 !important;
        }

        .about-container.push-right, main.push-right {
            transform: none;
            width: 100%;
        }

        .about-container h1 {
            font-size: 2.2em;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2e3a59;
        }

        .about-container p {
            font-size: 1.05em;
            margin-bottom: 18px;
            text-align: justify;
            color: #444;
            line-height: 1.7;
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

        @media (max-width: 768px) {
            main,
            .about-container {
                margin-left: 0 !important;
                padding: 50px 70px 0 70px;
                width: 100%;
                transition: transform 0.3s ease;
            }

            .about-container.push-right, main.push-right {
                transform: translateX(170px);
                width: calc(100% - 170px);
            }

            .about-container.full, main.full {
                margin-left: 0 !important;
            }

            .sidebar {
                transform: translateX(0);
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .body {
                overflow-x: hidden;
            }
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
            <a href="/aahowtousebootskill" style="color: white;">How to Use Boot Skill</a>
            <a class="copyright" style="color: white;">&copy; 2025 Boot Skill</a>
        </div>
    </nav>

    <div class="about-container push-right">
        <h1>About Boot Skill</h1>
        <p><strong>Boot Skill</strong> is a modern platform designed to help learners easily discover and enroll in bootcamps that align with their passions, goals, and learning needs. We partner with trusted bootcamp organizers from across Indonesia to bring you diverse and high-quality learning opportunities.</p>
        <p>Whether you're looking to level up in technology, digital skills, or creative fields, Boot Skill lets you explore bootcamps by topic, category, price, and organizer - all in one place. Our goal is to make learning more accessible, practical, and empowering for everyone, regardless of their background or location.</p>

        <p>Behind Boot Skill is a dedicated team of developers, designers, and educators committed to shaping the future of online learning through user-friendly technology and thoughtful experiences.</p>
        <p>We appreciate your trust. Let's grow together with Boot Skill.</p>
    </div>

    <div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const sidebar = document.getElementById("mainmenu");
            const mainContent = document.querySelector("main") || document.querySelector(".about-container");

            hamburgerBtn.addEventListener("click", function () {
                sidebar.classList.toggle("hidden");

                if(window.innerWidth <= 768) {
                    mainContent.classList.toggle("push-right");
                } else {
                    mainContent.classList.toggle("full");
                }

                hamburgerBtn.classList.toggle("active");
            });
        });
    </script>
</body>
</html>