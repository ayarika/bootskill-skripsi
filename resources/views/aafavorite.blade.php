<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Organizer</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .full {
            transition: margin-left 0.3s ease;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 10px;
            background: transparent;
            border: none;
            z-index: 1001;
            color: #2e3a59;
        }

        .hamburger-btn.active {
            color: white;
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
            transform: translateX(0);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a {
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
        }

        .sidebar h3 {
            margin-bottom: 20px;
            margin-top: 60px;
        }

        .main-content {
            margin-left: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.full {
            margin-left: calc(170px + 20px);
        }

        .footer-nav {
            margin-top: 180px;
            font-size: 0.85em;
            color: #fff;
        }

        .footer-nav .link-row {
            display: flex;
            justify-content: flex-start;
            gap: 8px;
            margin-bottom: 4px;
        }

        .footer-nav a {
            text-decoration: none;
            color: white;
            font-weight: normal;
            font-size: 0.85em;
            line-height: 1.2;
            display: inline-block;
            padding: 2px 0;
        }

        .footer-nav a[href="/aahowtousebootskill"] {
            display: block;
            margin-top: 2px;
            font-size: 0.9em;
        }

        .footer-nav .copyright {
            font-size: 0.8em;
            margin-top: 4px;
            display: block;
        }

        .favorite-organizers-section {
            padding: 20px;
        }

        .organizer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            justify-items: start;
        }

        .organizer-card {
            display: block;
            padding: 16px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            max-width: 260px;
            width: 100%;
            margin: 20px 0;
            text-decoration: none;
            color: #333;
        }

        .organizer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.12);
        }

        .organizer-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: block;
        }

        .organizer-name {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .view-btn {
            display: block;
            width: 100%;
            padding: 10px 0;
            background: #1e90ff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            margin-top: 10px;
            transition: background 0.25s ease;
        }

        .view-btn:hover {
            background: #176ac0;
        }

        @media (min-width: 1200px) {
            .organizer-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 768px) and (max-width: 1199px) {
            .organizer-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 480px) and (max-width: 767px) {
            .organizer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 479px) {
            .organizer-grid {
                grid-template-columns: 1fr;
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

    <nav id="mainmenu" class="sidebar">
        <h3 style="color: white;">Boot Skill</h3>
        <a href="/aamainhome" style="color: white;">Home</a>
        <a href="/aayourcourse" style="color: white;">Your Course</a>
        <a href="/aamyschedule" style="color: white;">My Schedule</a>
        <a href="/aafavorite" style="color: white;">Favorite</a>
        <a href="/settings" style="color: white;">Settings</a>

        <div class="footer-nav">
            <div class="link-row">
                <a href="/aaabout">About</a>
                <a href="/contactus">Contact Us</a>
            </div>
            <a href="/aahowtousebootskill">How To Use Boot Skill</a>
            <span class="copyright">&copy; 2025 Boot Skill</span>
        </div>
    </nav>

    <main id="mainpage" class="main-content">
        <section class="favorite-organizers-section">
            <h2>Your Favorites Organizers</h2>
            <p>Total Favorites: {{ $favorites->count() }}</p>
            @forelse ($favorites as $favorite)
                @if ($favorite->organizer)
                    <div class="organizer-card">
                        <img src="{{ $favorite->organizer->profile_picture_url }}"
                            alt="Organizer Photo">
                        <h4 class="organizer-name">{{ $favorite->organizer->name }}</h4>
                        <a href="{{ route('organizer.profile', $favorite->organizer->id) }}"
                            class="view-btn">View</a>
                    </div>
                @else
                    <div class="organizer-card">
                        No Favorite Organizer yet.
                    </div>
                @endif
            @empty
                <div>No favorite organizers available.</div>
            @endforelse
        </section>
    </main>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerbtn');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        if (localStorage.getItem('sidebarVisible') === 'true') {
            sidebar.classList.remove('hidden');
            mainContent.classList.add('full');
            hamburgerBtn.classList.add('active');
        } else {
            sidebar.classList.add('hidden');
            mainContent.classList.remove('full');
            hamburgerBtn.classList.remove('active');
        }

        hamburgerBtn.addEventListener('click', () => {
            const isHidden = sidebar.classList.contains('hidden');

            if (isHidden) {
                sidebar.classList.remove('hidden');
                mainContent.classList.add('full');
                hamburgerBtn.classList.add('active');
                localStorage.setItem('sidebarVisible', 'true');
            } else {
                sidebar.classList.add('hidden');
                mainContent.classList.remove('full');
                hamburgerBtn.classList.remove('active');
                localStorage.setItem('sidebarVisible', 'false');
            }
        });
    </script>
</body>
</html>
