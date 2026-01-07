<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

        .hamburger-btn rect {
            fill: currentColor;
        }

        .hamburger-btn.active rect {
            fill: #2e3a59;
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

        main {
            transition: margin-left 0.3s ease;
            will-change: margin-left;
        }

        .main.full {
            margin-left: 0;
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
            padding: 0 20px;
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

        .search-bar {
            display: flex;
            align-items: center;
            width: 95%;
            max-width: none;
            margin: 0;
            margin-left: 0;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px 10px;
            background-color: #fff;
        }

        .search-bar input[type="text"] {
            border: none;
            outline: none;
            padding: 8px;
            font-size: 14px;
            flex: 1;
            background: transparent;
        }

        .search-bar button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-bar:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-bar input [type="text"]:focus {
            width: 100%;
            flex: 1;
        }

        .notification {
            position: relative;
            cursor: pointer;
            padding-left: 13px;
            z-index: 1000;
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

        h2 {
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            
        }

        .bootcamp-link {
            text-decoration: none;
            color: inherit;
        }

        .bootcamp-card {
           background-color: #fff;
           border-radius: 10px;
           box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
           overflow: hidden;
           transition: transform 0.2s;
           display: flex;
           flex-direction: column;
           height: 100%;
        }

        .bootcamp-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .bootcamp-banner {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .bootcamp-card h4 {
            margin: 12px 16px 8px;
            font-size: 16px;
            color: #2e3a59;
        }

        .bootcamp-description {
            margin: 0 16px 8px;
            font-size: 14px;
            color: #555;
        }

        .organizer-name, .bootcamp-price {
            margin: 0 16px 8px;
            font-size: 13px;
            color: #666;
        }

        .bootcamp-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 0 20px;
            max-width: 1200px;
            margin: 40px auto;
        }

        .bootcamp-content {
            padding: 16px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .bootcamp-card h3 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #2e3a59;
        }

        .bootcamp-card p {
            font-size: 14px;
            color: #666;
            margin: 0 0 12px;
        }

        .bootcamp-info small {
            font-size: 12px;
            color: #444;
            line-height: 1.4;
        }

        .bootcamp-card:active {
            transform: scale(0.98);
            transition: transform 0.1s;
        }

        .bootcamp-card.selected {
            border: 2px solid #2e3a59;
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(46, 58, 89, 0.3);
        }

        .btn-primary {
            display: inline-block;
            padding: 8px 12px;
            background-color: #2e3a59;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #1e2a45;
        }

        .bootcamp-card-banner {
            position: relative;
        }

        .bootcamp-card-banner img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .banner-tags {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .tag {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .price-tag {
            background: #1e90ff;
        }

        .category-tag {
            background: #28a745;
        }

        .topics-tag {
            background: #722db7;
        }

        .organizer-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
        }

        .organizer-info {
            display: flex;
            align-items: center;
        }

        .organizer-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            flex: 0 0 35px;
            margin-left: 4px;
        }

        .organizer-name {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            line-height: 1.3;
            max-width: calc(100% - 44px);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .organizer-info {
            margin-top: 8px;
            padding: 0 2px;
        }

        @media (max-width: 600px) {
            main, main.full {
                margin-left: 0 !important;
                padding: 10px 12px;
            }

            .search-bar {
                margin-top: 80px;
                flex-direction: column;
                align-items: center;
            }

            .search-bar input[type="text"],
            .search-bar button {
                max-width: 500px;
                border-radius: 8px;
                margin-bottom: 8px;
            }

            .search-bar button {
                border-radius: 8px;
            }
            
            .search-result-container {
                grid-template-columns: 1fr;
                gap: 16px;
                padding: 0 12px;
            }

            .bootcamp-card {
                width: 100%;
                box-sizing: border-box;
            }

            .bootcamp-banner {
                height: 160px;
            }

            .bootcamp-card h3 {
                font-size: 16px;
            }

            .bootcamp-card p,
            .bootcamp-info small {
                font-size: 13px;
            }
        }

        @media (max-width: 900px) {
            .search-result-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .search-result-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                padding: 10px 20px;
            }

            main {
                margin-left: 170px;
                padding: 20px 40px;
            }

            main.full {
                margin-left: 0;
                padding: 20px;
            }

            .bootcamp-card {
                width: 100%;
                min-height: 100%;
            }
        }

        @media (max-width: 768px) {
            .search-bar {
                flex-direction: row;
                justify-content: center;
                gap: 0;
                padding-left: 20px;
            }

            .search-bar input[type="text"] {
                border-radius: 8px 0 0 8px;
                width: 400px;
            }

            .search-bar button {
                border-radius: 0 8px 8px 0;
                width: auto;
                white-space: nowrap;
            }

            .search-result-container {
                display: grid;
                grid-template-columns: 1fr;
                gap: 16px;
                padding: 0 12px;
            }
        }

        @media (max-width: 1200px) {
            main {
                padding-left: 50px;
                padding-right: 50px;
            }
        }

        .search-result-wrapper {
            display: flex;
            gap: 20px;
        }

        .search-result-container {
            width: 70%;
        }

        .search-organizer-container {
            width: 30%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .organizer-small-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: 0.2s ease;
            text-decoration: none;
        }

        .organizer-small-card:hover {
            background: #f4f8ff;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .organizer-small-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            background: #f0f0f0;
        }

        .organizer-small-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .organizer-small-info h4 {
            font-size: 17px;
            font-weight: 600;
            color: #222;
            margin: 0;
            margin-bottom: 3px;
        }

        .organizer-small-info p {
            margin: 0;
            font-size: 13px;
            color: #777;
        }

        @media(max-width: 900px) {
            .organizer-small-avatar {
                width: 50px;
                height: 50px;
            }

            .organizer-small-info h4 {
                font-size: 16px;
            }
        }

        @media(max-width: 650px) {
            .search-result-wrapper {
                flex-direction: column;
            }

            .search-result-container,
            .search-organizer-container {
                width: 100%;
            }
        }

        .view-details-wrapper {
            margin-top: 12px;
            text-align: left;
            padding: 0 20px;
        }

        .view-details-btn {
            display: block;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            background: #1e90ff;
            color: white;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .view-details-btn:hover {
            background: #0c6ad8;
        }

        @media (min-width: 1400px) {
            .bootcamp-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 900px) and (max-width: 1399px) {
            .bootcamp-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 899px) {
            .bootcamp-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }
        }

        @media (max-width: 1300px) {
            .bootcamp-card h3,
            .bootcamp-card h4,
            .bootcamp-description,
            .organizer-name,
            .bootcamp-info small,
            .bootcamp-card p {
                word-break: break-word;
                overflow-wrap: break-word;
                white-space: normal;
            }
        }

        @media (max-width: 1300px) and (min-width: 900px) {
            .banner-tags {
                top: 8px;
                left: 8px;
                gap: 4px;
                max-width: calc(100% - 16px);
            }

            .tag {
                padding: 3px 6px;
                font-size: 11px;
                border-radius: 5px;
            }

            .price-tag,
            .category-tag,
            .topis-tag {
                white-space: nowrap;
            }
        }

        @media (max-width: 1400px) {
            main {
                margin-left: 170px !important;
                padding-left: 60px !important;
            }

            main.full {
                margin-left: 0 !important;
            }

            .bootcamp-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1400px) {
            .bootcamp-grid {
                grid-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .bootcamp-grid {
                grid-template-columns: 1fr;
            }
        }

        .search-result-wrapper {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            width: 100%;
            box-sizing: border-box;
        }

        .search-result-container {
            flex: 0 0 68%;
            max-width: 68%;
            box-sizing: border-box;
            min-width: 0;
        }

        .search-organizer-container {
            flex: 0 0 30%;
            max-width: 30%;
            box-sizing: border-box;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .organizer-small-card {
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
            padding: 12px 14px;
            gap: 12px;
        }

        .organizer-small-info h4,
        .organizer-name {
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .organizer-small-avatar {
            width: 56px;
            height: 56px;
            flex-shrink: 0;
        }

        .banner-tags {
            top: 8px;
            left: 8px;
            right: 8px;
            max-width: calc(100% - 16px);
            display: flex;
            flex-wrap: wrap;
            box-sizing: border-box;
        }

        @media (max-width: 1400px) {
            .search-result-container {
                flex-basis: 66%;
                max-width: 66%;
            }
            .search-organizer-container {
                flex-basis: 32%;
                max-width: 32%;
            }
            .tag {
                padding: 3px 6px;
                font-size: 11px;
            }
        }

        @media (max-width: 650px) {
            .search-result-wrapper {
                flex-direction: column;
            }

            .search-result-container,
            .search-organizer-container {
                flex-basis: 100%;
                max-width: 100%;
            }
        }

        .bootcamp-card, .organizer-small-card {
            overflow: hidden;
            word-wrap: break-word;
        }

        .search-result-container[style] {
            box-sizing: border-box;
        }

        @media (max-width: 1400px) {
            .organizer-avatar {
                width: 30px;
                height: 30px;
            }

            .organizer-name {
                font-size: 13px;
            }

            .search-organizer-container {
                width: 33%;
            }

            .search-result-container {
                width: 67%;
            }
        }

        .search-result-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .search-result-container {
            flex: 1 1 65%;
            max-width: 65%;
        }

        .search-organizer-container {
            flex: 1 1 35%;
            max-width: 35%;
        }

        @media (max-width: 1200px) {
            .search-result-container,
            .search-organizer-container {
                flex-basis: 100% !important;
                max-width: 100% !important;
            }
        }

        @media(max-width: 768px) {
            .search-result-wrapper {
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .search-result-wrapper {
                gap: 10px;
            }
            .bootcamp-card {
                width: 100%;
            }
        }

        .organizer-name {
            white-space: nowrap;
            overflow: visible !important;
            text-overflow: clip !important;
            display: inline-block;
            flex-shrink: 1;
        }

        .organizer-info {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .organizer-link {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .search-result-wrapper {
            width: 100%;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .search-result-container {
            flex: 1;
            max-width: 70%;
        }

        .search-organizer-container {
            width: 30%;
        }

        .tag {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .countdown-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fff;
            z-index: 5;
            white-space: nowrap;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .countdown-badge.today {
            background: #ef4444;
        }

        .countdown-badge.soon {
            background: #f59e0b;
        }

        .countdown-badge.upcoming {
            background: #3b82f6;
        }

        .countdown-badge.started {
            background: #16a34a;
        }
        
    </style>
</head>

<body>
    <button id="hamburgerbtn" class="hamburger-btn" aria-label="Toggle menu">
        <svg width="30" height="30" viewBox="0 0 100 80" aria-hidden="true">
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
        <form action="{{ route('search.bootcamp') }}" method="GET" class="search-bar">
            <input type="text" name="query" id="searchId" placeholder="Search bootcamp..." value="{{ request('query') }}" >
            <button type="submit" aria-label="Submit search">
                <svg width="20" height="20" fill="#2e3a59" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>
        
        <h2 style="margin-left: 20px;"> Results for: <em> {{ $query }}</em></h2>
        
        <div class="search-result-wrapper">
            <div class="search-organizer-container">
                @foreach ($organizer as $org)
                    <a href="{{ route('organizer.profile', ['id' => $org->id]) }}" class="organizer-small-card">
                        <img
                            src="{{ $org->profile_picture_url }}"
                            alt="{{ $org->name }}"
                            class="organizer-small-avatar">
                        
                        <div class="organizer-small-info">
                            <h4>{{ $org->name }}</h4>
                            <p>Organizer</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="search-result-container">
                @forelse ($results as $event)
                        <div class="bootcamp-card clickable-card" 
                            data-start-date="{{ $event->start_date }}"
                            onclick="window.location='{{ route('bootcamp.detail', $event->id) }}'">
                            <div class="bootcamp-card-banner">
                                <img
                                    src="{{ $event->image_path && file_exists(public_path($event->image_path))
                                            ? asset( $event->image_path) 
                                            : asset('images/defaults.png') }}"
                                    alt="{{ $event->title }}"
                                    onerror="this.onerror=null;this.src='/images/defaults.png';">

                                <div class="banner-tags">
                                    <span class="tag price-tag">
                                        @if ($event->price == 0)
                                            FREE
                                        @else
                                            Rp {{ number_format($event->price, 0, ',', '.') }}
                                        @endif
                                    </span>

                                    <span class="tag category-tag">{{ $event->category }}</span>
                                    <span class="tag topics-tag">{{ $event->topic }}</span>
                                </div>

                                <div class="countdown-badge"></div>
                            </div>

                            <div class="bootcamp-content">
                                <h3 class="bootcamp-title">{{ $event->title }}</h3>
                                <p class="bootcamp-description">{{ Str::limit($event->description, 80) }}</p>

                                <div class="organizer-info" style="margin-top: 10px;">
                                    <a href="{{ route('organizer.profile', ['id' => $event->organizer->id]) }}" class="organizer-link">
                                        <img
                                            src="{{ $event->organizer->profile_picture_url }}"
                                            alt="Organizer Photo"
                                            class="organizer-avatar">
                                        <span class="organizer-name">{{ $event->organizer->name }}</span>
                                    </a>
                                </div>

                                <div class="view-details-wrapper">
                                    <a href="{{ route('bootcamp.detail', $event->id) }}" class="view-details-btn">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                @empty
                    <p>No result has been found: <strong>{{ $query }}</strong>.</p>
                @endforelse
            </div>
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

            const cards = document.querySelectorAll(".bootcamp-card");
            const today = new Date();
            today.setHours(0,0,0,0);

            cards.forEach(card => {
                const startDateStr = card.dataset.startDate;
                if (!startDateStr) return;

                const startDate = new Date(startDateStr);
                startDate.setHours(0,0,0,0);

                const diffDays = Math.ceil(
                    (startDate - today) / (1000 * 60 * 60 *24)
                );

                const badge = card.querySelector(".countdown-badge");
                if (!badge) return;

                if(diffDays > 1) {
                    badge.textContent = `Starts in ${diffDays} days`;
                    badge.classList.add("upcoming");
                } else if (diffDays === 1) {
                    badge.textContent = "Starts tomorrow";
                    badge.classList.add("soon");
                } else if (diffDays === 0) {
                    badge.textContent = "Starts today";
                    badge.classList.add("today");
                } else {
                    badge.textContent = "Started";
                    badge.classList.add("started");
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll(".bootcamp-card");

            cards.forEach(card => {
                card.addEventListener("click", function () {
                    cards.forEach(c => c.classList.remove("selected"));
                    card.classList.add("selected");
                });
            });
        });
    </script>
</body>
</html>